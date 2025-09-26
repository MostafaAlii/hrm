<?php

namespace App\Enums\Employee;

enum WorkingStatus: string {
    case Working    = 'working';      // يعمل
    case Vacation   = 'vacation';     // إجازة
    case SickLeave  = 'sick_leave';   // إجازة مرضية
    case Absent     = 'absent';       // غياب
    case RemoteWork = 'remote_work';  // عمل عن بعد
    case Suspended  = 'suspended';    // موقوف مؤقتًا
    case Terminated = 'terminated';   // منتهي الخدمة

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    public static function labels(): array
    {
        return [
            self::Working->value    => 'يعمل',
            self::Vacation->value   => 'إجازة',
            self::SickLeave->value  => 'إجازة مرضية',
            self::Absent->value     => 'غياب',
            self::RemoteWork->value => 'عمل عن بعد',
            self::Suspended->value  => 'موقوف',
            self::Terminated->value => 'منتهى الخدمة',
        ];
    }
}
