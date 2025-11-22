<?php
namespace App\Services;
use App\Models\TimeManagmentGeneralguideline;
use App\Services\Contracts\CustomMonthInterface;
use Carbon\Carbon;
class CustomMonthService implements CustomMonthInterface {
    protected int $startDay;
    public function __construct() {
        $this->startDay = TimeManagmentGeneralguideline::where('company_id', get_user_data()->company_id)->value('starts_month') ?? 1;
    }

    public function getMonthStart(int $month, ?int $year = null): string {
        $year = $year ?? Carbon::now()->year - 1;
        return Carbon::create($year, $month, $this->startDay)
            ->subMonth()
            ->format('Y-m-d');
    }

    public function getMonthEnd(int $month, ?int $year = null): string {
        $year = $year ?? Carbon::now()->year - 1;
        return Carbon::create($year, $month, $this->startDay)
            ->subDay()
            ->format('Y-m-d');
    }

    public function getMonthNameArabic(int $month): string {
        $names = [
            1  => 'يناير',
            2  => 'فبراير',
            3  => 'مارس',
            4  => 'أبريل',
            5  => 'مايو',
            6  => 'يونيو',
            7  => 'يوليو',
            8  => 'أغسطس',
            9  => 'سبتمبر',
            10 => 'أكتوبر',
            11 => 'نوفمبر',
            12 => 'ديسمبر',
        ];
        return $names[$month] ?? '';
    }

    /**
     * تحديد رقم الشهر حسب نظام البداية start_day
     */
    public function getCustomMonthForDate(Carbon $date): int {
        // لو اليوم أقل من start_day → يعتبر من الشهر السابق
        return $date->day < $this->startDay
            ? $date->copy()->subMonth()->month
            : $date->month;
    }

    public function getCurrentCustomMonth(): int {
        return $this->getCustomMonthForDate(Carbon::now());
    }

    public function getCurrentMonthNameArabic(): string {
        return $this->getMonthNameArabic(
            $this->getCurrentCustomMonth()
        );
    }

    public function getCurrentMonthRange(?int $year = null): array {
        $month = $this->getCurrentCustomMonth();
        $year = $year ?? Carbon::now()->year; // نستخدم السنة الحالية (مع حساب start_day)
        return [
            'start' => $this->getMonthStart($month, $year),
            'end'   => $this->getMonthEnd($month, $year),
        ];
    }
    /**
     * كل أيام الشهر بالنظام الخاص
     * @param Carbon|null $date : أي يوم داخل الشهر المطلوب (افتراضي اليوم الحالي)
     * @return array : [21, 22, ..., 20]
     */
    public function getCustomMonthDays(?Carbon $date = null): array {
        $date = $date ?? Carbon::now();
        $month = $this->getCustomMonthForDate($date);
        $year = $date->year;
        $start = Carbon::create($year, $month, $this->startDay);
        if ($date->day < $this->startDay) {
            $start->subMonth();
            $year = $start->year;
        }
        $end = $start->copy()->addMonth()->subDay();
        $days = [];
        $current = $start->copy();
        while ($current->lte($end)) {
            $days[] = $current->day;
            $current->addDay();
        }
        return $days;
    }

    /**
     * ترجمة أيام الأسبوع للعربية حسب البداية المخصصة
     * @param string|null $startWeek اليوم الذي يبدأ منه الأسبوع (saturday, sunday...)
     * @return array ['السبت', 'الأحد', ...]
     */
    public function getWeekDaysArabic(?string $startWeek = null): array {
        $week = [
            'saturday'  => 'السبت',
            'sunday'    => 'الأحد',
            'monday'    => 'الإثنين',
            'tuesday'   => 'الثلاثاء',
            'wednesday' => 'الأربعاء',
            'thursday'  => 'الخميس',
            'friday'    => 'الجمعة',
        ];
        $startWeek = $startWeek ?? TimeManagmentGeneralguideline::where('company_id', get_user_data()->company_id)->value('starts_week') ?? 'saturday';
        // نعيد ترتيب الأيام حسب البداية
        $keys = array_keys($week);
        $startIndex = array_search($startWeek, $keys);
        $orderedKeys = array_merge(array_slice($keys, $startIndex), array_slice($keys, 0, $startIndex));
        $result = [];
        foreach ($orderedKeys as $key) {
            $result[] = $week[$key];
        }
        return $result;
    }

    public function getWeekDaysArabicWithColor(?string $startWeek = null): array
    {
        $week = [
            'saturday'  => ['name' => 'السبت', 'color' => '#f0ad4e', 'dayOfWeek' => 6],
            'sunday'    => ['name' => 'الأحد', 'color' => '#d9534f', 'dayOfWeek' => 0],
            'monday'    => ['name' => 'الإثنين', 'color' => '#5bc0de', 'dayOfWeek' => 1],
            'tuesday'   => ['name' => 'الثلاثاء', 'color' => '#5cb85c', 'dayOfWeek' => 2],
            'wednesday' => ['name' => 'الأربعاء', 'color' => '#f7e500', 'dayOfWeek' => 3],
            'thursday'  => ['name' => 'الخميس', 'color' => '#a569bd', 'dayOfWeek' => 4],
            'friday'    => ['name' => 'الجمعة', 'color' => '#ff69b4', 'dayOfWeek' => 5],
        ];

        $startWeek = $startWeek ?? TimeManagmentGeneralguideline::where('company_id', get_user_data()->company_id)->value('starts_week') ?? 'saturday';

        // ترتيب الأيام حسب البداية
        $keys = array_keys($week);
        $startIndex = array_search($startWeek, $keys);
        $orderedKeys = array_merge(array_slice($keys, $startIndex), array_slice($keys, 0, $startIndex));

        $result = [];
        foreach ($orderedKeys as $key) {
            $result[] = $week[$key];
        }
        return $result;
    }




    /*public function getMonthsWithDays(?int $year = null): array {
        $year = $year ?? Carbon::now()->year;
        $result = [];
        for ($m = 1; $m <= 12; $m++) {
            $monthName = $this->getMonthNameArabic($m);
            // نستخدم اليوم 1 من كل شهر لحساب أيامه بالنظام الخاص
            $days = $this->getCustomMonthDays(Carbon::create(Carbon::now()->year, $m, 1));
            $result[$monthName] = $days;
        }
        return $result;
    }*/
    public function getMonthsWithDays(?int $year = null): array
    {
        $year = $year ?? Carbon::now()->year;

        $result = [];

        for ($m = 1; $m <= 12; $m++) {

            // اسم الشهر بالعربي
            $monthName = $this->getMonthNameArabic($m);

            // نستخدم اليوم 1 من الشهر والسنة التي تم تمريرها
            $date = Carbon::create($year, $m, 1);

            // الحصول على أيام الشهر بالنظام المخصص
            $days = $this->getCustomMonthDays($date);

            // تخزين النتيجة
            $result[$monthName] = $days;
        }
        return $result;
    }
}
