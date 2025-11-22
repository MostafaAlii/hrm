<?php
namespace App\Services\Contracts;
use Carbon\Carbon;
interface CustomMonthInterface {
    public function getMonthStart(int $month, ?int $year = null): string;
    public function getMonthEnd(int $month, ?int $year = null): string;
    public function getMonthNameArabic(int $month): string;
    /**
     * ترجع الشهر الحالي حسب نظام الشركة (start_day مخصص للشهر)
     * مثال: لو start_day = 21 → يوم 25-10 ينتمي لشهر 11 بالنظام ده
     */
    public function getCurrentCustomMonth(): int;
    public function getCustomMonthForDate(Carbon $date): int;
    /** اسم الشهر الحالي عربي بالنظام الخاص */
    public function getCurrentMonthNameArabic(): string;
    /** بداية ونهاية الشهر الحالي بالنظام الخاص */
    public function getCurrentMonthRange(?int $year = null): array;
    public function getCustomMonthDays(?Carbon $date = null): array;
    public function getWeekDaysArabic(?string $startWeek = null): array;
    /** الشهور مع الأيام حسب start_day */
    public function getMonthsWithDays(?int $year = null): array;
    public function getWeekDaysArabicWithColor(?string $startWeek = null): array;
}