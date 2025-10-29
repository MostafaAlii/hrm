<?php

namespace App\Enums\ShiftType;

enum ShiftType: string {
    case MORNING = 'morning';   // شيفت صباحي
    case EVENING = 'evening';   // شيفت مسائي
    case FLEXIBLE = 'flexible'; // شيفت متغير

    public static function label($value): string
    {
        //$value = (string)$value;
        return match ($value) {
            self::MORNING => trans('dashboard/shift_types.morning'),
            self::EVENING => trans('dashboard/shift_types.evening'),
            self::FLEXIBLE => trans('dashboard/shift_types.flexible'),
            default => trans('dashboard/general.not_type_assigned'),
        };
    }

    public static function badge($value): string
    {
        return match ($value) {
            self::MORNING  => '<span class="badge bg-primary">'   . trans('dashboard/shift_types.morning') . '</span>',
            self::EVENING  => '<span class="badge bg-info">'      . trans('dashboard/shift_types.evening') . '</span>',
            self::FLEXIBLE => '<span class="badge bg-warning">'   . trans('dashboard/shift_types.flexible') . '</span>',
            default        => '<span class="badge bg-default">'   . trans('dashboard/general.not_type_assigned') . '</span>',
        };
    }
}
