<?php
namespace App\Enums\Penalty;
enum CalculationType: string {
    case BaseSalaryDays   = 'base_salary_days';    // أيام من المرتب الأساسي
    case TotalSalaryDays  = 'total_salary_days';   // أيام من المرتب الكلي
    case Value            = 'value';               // قيمة
    case Other            = 'other';               // آخر

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    public static function labels(): array
    {
        return [
            self::BaseSalaryDays->value  => 'أيام من المرتب الأساسي',
            self::TotalSalaryDays->value => 'أيام من المرتب الكلي',
            self::Value->value           => 'قيمة',
            self::Other->value           => 'آخر',
        ];
    }
}
