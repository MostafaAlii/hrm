<?php
namespace App\Enums\Penalty;
enum PenaltyType: string {
    case Warning  = 'warning';    // إنذار
    case Deduction = 'deduction'; // خصم
    case Other    = 'other';      // آخر

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    public static function labels(): array
    {
        return [
            self::Warning->value   => 'إنذار',
            self::Deduction->value => 'خصم',
            self::Other->value     => 'آخر',
        ];
    }
}
