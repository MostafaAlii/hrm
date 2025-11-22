<?php
namespace App\Services;
use App\Models\TimeManagmentGeneralGuideline;
use App\Services\Contracts\CustomMonthInterface;
use Carbon\Carbon;
class CustomMonthService implements CustomMonthInterface {
    protected int $startDay;
    public function __construct() {
        $this->startDay = TimeManagmentGeneralGuideline::where('company_id', get_user_data()->company_id)->value('starts_month') ?? 1;
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

    public function getCurrentMonthRange(): array {
        $month = $this->getCurrentCustomMonth();
        $year  = Carbon::now()->year; // نستخدم السنة الحالية (مع حساب start_day)
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
}
