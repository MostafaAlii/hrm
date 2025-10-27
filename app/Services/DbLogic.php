<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class DbLogic
{
    /* =========================================================
     |  1) Stored Procedures (SP) Wrappers
     |=========================================================*/

    /** بديل Trigger: employees_after_insert */
    public static function applyEmpPolicies(string $cocode, string $empCode, string $adduser): void
    {
        DB::statement("CALL emppolicies(?, ?, ?)", [$cocode, $empCode, $adduser]);
    }

    /** بديل Trigger: Permission (AFTER INSERT ON groups) */
    public static function applyGroupPolicies(string $cocode, string $groupCode, string $adduser): void
    {
        DB::statement("CALL grouppolicies(?, ?, ?)", [$cocode, $groupCode, $adduser]);
    }

    /** بديل Trigger: New_company (AFTER INSERT ON companies) */
    public static function provisionNewCompany(string $companyCode, string $adduser): void
    {
        DB::statement("CALL newcompany(?, ?)", [$companyCode, $adduser]);
    }

    /** بديل Trigger: advances_after_insert (AFTER INSERT ON advances) */
    public static function generateAdvance(string $advanceGiud): void
    {
        DB::statement("CALL generate_advance(?)", [$advanceGiud]);
    }


    /* =========================================================
     |  2) Groups / Companies cascades
     |=========================================================*/

    /** بديل AFTER DELETE ON groups → delete groupperm */
    public static function deleteGroupPermOnGroupDelete(string $cocode, string $groupRowId): int
    {
        return DB::table('groupperm')
            ->where('cocode', $cocode)
            ->where('gid', $groupRowId)
            ->delete();
    }


    /* =========================================================
     |  3) Advances (السلف/الأقساط)
     |=========================================================*/

    /**
     * بديل advancesupdate (AFTER UPDATE ON advancesd):
     * لو مفيش سطور done='0' في advancesd → advances.done='1' وإلا '0'.
     * مع نقل lastedit/edituser.
     */
    public static function recomputeAdvanceDone(
        string $cocode,
        string $advanceRefGiud,
        string $lastedit,
        string $edituser
    ): void {
        $open = DB::table('advancesd')
            ->where('cocode', $cocode)
            ->where('advance_ref', $advanceRefGiud)
            ->where('done', '0')
            ->count();

        $done = $open === 0 ? '1' : '0';

        DB::table('advances')
            ->where('cocode', $cocode)
            ->where('giud', $advanceRefGiud)
            ->update([
                'done'     => $done,
                'lastedit' => $lastedit,
                'edituser' => $edituser,
            ]);
    }

    /** بديل delete_kists (AFTER INSERT ON advance_payed) */
    public static function deleteOpenInstallmentsAfterPayment(string $cocode, string $advanceRefGiud): int
    {
        return DB::table('advancesd')
            ->where('cocode', $cocode)
            ->where('advance_ref', $advanceRefGiud)
            ->where('done', '0')
            ->delete();
    }

    /**
     * بديل chnagegurnator (AFTER UPDATE ON advances)
     * يضيف سجل في changeguarantor عند تغيّر الضامن1/2
     * ملاحظة: مسألة تهجئة guaranto(r)2/gurana(t)or2 — احرص اتطابق أسماء الأعمدة مع سكيمتك.
     */
    public static function logGuarantorChanges(array $old, array $new, string $edituser): void
    {
        // الضامن الأول
        $oldG1 = $old['guarantor1'] ?? null;
        $newG1 = $new['guarantor1'] ?? null;
        if ($oldG1 !== $newG1) {
            DB::table('changeguarantor')->insert([
                'cocode'       => $old['cocode'] ?? $new['cocode'] ?? '',
                'advance_ref'  => $old['giud']   ?? $new['giud']   ?? '',
                'firstorsecond' => 0,
                'gfrom'        => $oldG1,
                'gto'          => $newG1,
                'adduser'      => $edituser,
            ]);
        }

        // الضامن الثاني (حاول نجمع الاختلاف في التهجئة)
        $oldG2 = $old['guranator2'] ?? $old['guarantor2'] ?? null;
        $newG2 = $new['guranator2'] ?? $new['guarantor2'] ?? null;

        if ($oldG2 !== $newG2) {
            DB::table('changeguarantor')->insert([
                'cocode'       => $old['cocode'] ?? $new['cocode'] ?? '',
                'advance_ref'  => $old['giud']   ?? $new['giud']   ?? '',
                'firstorsecond' => 1,
                'gfrom'        => $oldG2,
                'gto'          => $newG2,
                'adduser'      => $edituser,
            ]);
        }
    }


    /* =========================================================
     |  4) Vacations (الإجازات) وتفاصيلها
     |=========================================================*/

    /** بديل جزء من employees_vacations_before_insert: جلب الرمز من vacations */
    public static function resolveVacationSymbol(string $cocode, string $vacCode): ?string
    {
        return DB::table('vacations')
            ->where('cocode', $cocode)
            ->where('code', $vacCode)
            ->value('symbol');
    }

    /** بديل حساب days = DATEDIFF(to, from) + 1 لنوع الفترة type=0 */
    public static function computeVacationDays(?string $fromDate, ?string $toDate, int $type): ?int
    {
        if ($type !== 0 || !$fromDate || !$toDate) {
            return null;
        }
        $from = Carbon::parse($fromDate)->startOfDay();
        $to   = Carbon::parse($toDate)->startOfDay();
        return $from->diffInDays($to) + 1;
    }

    /**
     * بديل setvacdetails + updatedetailsapproved:
     * يبني/يعيد بناء empvacdetails حسب النوع:
     * - type=0: فترة من/إلى → صف لكل يوم
     * - type=1: يوم واحد → صف واحد بتاريخ new.date
     */
    public static function buildVacationDetails(
        string $cocode,
        string $vacGiud,
        string $empcode,
        string $symbol,
        bool $approved,
        int $type,
        string $adduser,
        string $vacCode,
        ?string $fromDate,
        ?string $toDate,
        ?string $singleDate
    ): void {
        // امسح القديم (يُستخدم أيضاً في updatedetailsapproved)
        DB::table('empvacdetails')
            ->where('cocode', $cocode)
            ->where('vacgiud', $vacGiud)
            ->delete();

        if ($type === 0 && $fromDate && $toDate) {
            $from = Carbon::parse($fromDate);
            $to   = Carbon::parse($toDate);
            for ($d = $from->copy(); $d->lte($to); $d->addDay()) {
                DB::table('empvacdetails')->insert([
                    'vdate'    => $d->toDateString(),
                    'vacgiud'  => $vacGiud,
                    'cocode'   => $cocode,
                    'empcode'  => $empcode,
                    'symbol'   => $symbol,
                    'vptype'   => $type,
                    'approved' => $approved ? 1 : 0,
                    'adduser'  => $adduser,
                    'vaccode'  => $vacCode,
                ]);
            }
        } elseif ($type === 1 && $singleDate) {
            DB::table('empvacdetails')->insert([
                'vdate'    => Carbon::parse($singleDate)->toDateString(),
                'vacgiud'  => $vacGiud,
                'cocode'   => $cocode,
                'empcode'  => $empcode,
                'symbol'   => $symbol,
                'vptype'   => $type,
                'approved' => $approved ? 1 : 0,
                'adduser'  => $adduser,
                'vaccode'  => $vacCode,
            ]);
        }
    }

    /** بديل deletefromdetails (BEFORE DELETE ON employees_vacations) */
    public static function deleteEmpVacDetailsByVacGiud(string $vacGiud): int
    {
        return DB::table('empvacdetails')->where('vacgiud', $vacGiud)->delete();
    }

    /** بديل deletevacationassign (AFTER DELETE ON employees_assign_vacation) */
    public static function deleteEmpVacIncOnAssignDelete(
        string $cocode,
        string $vac_code,
        string $empcode,
        string $vyear
    ): int {
        return DB::table('employees_vacations_inc')
            ->where('cocode', $cocode)
            ->where('vac_code', $vac_code)
            ->where('empcode', $empcode)
            ->where('vyear', $vyear)
            ->delete();
    }


    /* =========================================================
     |  5) Holidays (العطلات العامة) وتفاصيلها
     |=========================================================*/

    /** بديل setdetails/updatedetails/deletedetails1 عبر بناء holidaydetails بالبرمجة */
    public static function rebuildHolidayDetails(
        string $cocode,
        string $holidaysCode,
        string $hdGiud,     // htgiud/giud الخاص بالمدة
        string $fromDate,
        string $toDate,
        string $adduser
    ): void {
        // امسح تفاصيل العطلة لهذه العطلة/الشركة
        DB::table('holidaydetails')
            ->where('cocode', $cocode)
            ->where('hcode', $holidaysCode)
            ->delete();

        $from = Carbon::parse($fromDate);
        $to   = Carbon::parse($toDate);
        for ($d = $from->copy(); $d->lte($to); $d->addDay()) {
            DB::table('holidaydetails')->insert([
                'cocode'  => $cocode,
                'hcode'   => $holidaysCode,
                'htgiud'  => $hdGiud,
                'hdate'   => $d->toDateString(),
                'adduser' => $adduser,
            ]);
        }
    }

    /** بديل deleteall (AFTER DELETE ON holidays) */
    public static function deleteHolidayHeadersCascade(string $cocode, string $holidayCode): void
    {
        DB::table('holidays_duration')
            ->where('cocode', $cocode)
            ->where('holidays_code', $holidayCode)
            ->delete();

        DB::table('holidaydetails')
            ->where('cocode', $cocode)
            ->where('hcode', $holidayCode)
            ->delete();
    }

    /** بديل deletedetails1 (AFTER DELETE ON holidays_duration) */
    public static function deleteHolidayDetailsByDurationGiud(string $durationGiud): int
    {
        return DB::table('holidaydetails')->where('htgiud', $durationGiud)->delete();
    }


    /* =========================================================
     |  6) Employees / Salaries logic
     |=========================================================*/

    /**
     * بديل الجزء الأول في setsalworkdays:
     * حساب workdays والدayspart وتحديث سطر salaries للفترة الحالية.
     * يتطلب تواجد getworkdaysinmonth و getperiod في الداتابيز.
     */
    /*public static function recalcSalaryWorkdaysForCurrentPeriod(string $cocode, string $empcode): void
    {
        $period = DB::table('companies')->where('code', $cocode)->value('period');
        if (!$period) {
            return;
        }

        $dt = Carbon::parse($period);
        $vpYear  = str_pad((string) $dt->year, 4, '0', STR_PAD_LEFT);
        $vpMonth = str_pad((string) $dt->month, 2, '0', STR_PAD_LEFT);

        $row = DB::selectOne("SELECT getworkdaysinmonth(?, ?, ?, ?) AS w", [$cocode, $empcode, $vpMonth, $vpYear]);
        if (!$row) {
            return;
        }

        $workdays = (float) $row->w;
        $dayspart = $workdays / 30.0;

        $currentPeriod = DB::selectOne("SELECT getperiod(?) AS p", [$cocode])->p ?? null;
        if (!$currentPeriod) {
            return;
        }

        DB::table('salaries')
            ->where('cocode', $cocode)
            ->where('empcode', $empcode)
            ->whereRaw("CONCAT(vyear,'-',vmonth) = ?", [$currentPeriod])
            ->update([
                'dayspart' => $dayspart,
                'wdays'    => $workdays,
            ]);
    }*/

    /**
     * بديل بقية الحالات في setsalworkdays (تغير wcode/dcode/work).
     * مرّر فقط الحقول المطلوب تحديثها (wpcode/dcode/work).
     */
    public static function syncSalaryFieldsForCurrentPeriod(string $cocode, string $empcode, array $fields): void
    {
        if (empty($fields)) return;

        $allowed = ['wpcode', 'dcode', 'work'];
        $payload = array_intersect_key($fields, array_flip($allowed));
        if (!$payload) return;

        $currentPeriod = DB::selectOne("SELECT getperiod(?) AS p", [$cocode])->p ?? null;
        if (!$currentPeriod) return;

        DB::table('salaries')
            ->where('cocode', $cocode)
            ->where('empcode', $empcode)
            ->whereRaw("CONCAT(vyear,'-',vmonth) = ?", [$currentPeriod])
            ->update($payload);
    }


    /* =========================================================
     |  7) Departments cascades (deletedjobs)
     |=========================================================*/

    /**
     * بديل deletedjobs (AFTER DELETE ON departments)
     * لو controlline=0 → نحذف depjobs/depaccinterface
     * لو controlline=1 → نحذف managersassign
     */
    public static function deleteDepartmentRelationsOnDelete(
        string $cocode,
        string $deptCode,
        int $controlLine
    ): void {
        if ($controlLine === 0) {
            DB::table('depjobs')->where('cocode', $cocode)->where('dcode', $deptCode)->delete();
            DB::table('depaccinterface')->where('cocode', $cocode)->where('dcode', $deptCode)->delete();
        } elseif ($controlLine === 1) {
            DB::table('managersassign')->where('cocode', $cocode)->where('managementid', $deptCode)->delete();
        }
    }
}
