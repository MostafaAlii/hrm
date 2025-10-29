<?php

namespace App\Enums\Employee;

enum WorkingStatus: string
{
    case Working    = 'working';      // يعمل
    case Vacation   = 'vacation';     // إجازة
    case SickLeave  = 'sick_leave';   // إجازة مرضية
    case Absent     = 'absent';       // غياب
    case RemoteWork = 'remote_work';  // عمل عن بعد
    case Suspended  = 'suspended';    // موقوف مؤقتًا
    case Terminated = 'terminated';   // منتهي الخدمة
    case WorkSuspended  = 'work_suspended';    // موقوف عن العمل
    case Resignation    = 'resignation';       // استقاله
    case Transferred    = 'transferred';       // منقول
    case UnpaidLeave    = 'unpaid_leave';      // اجازه بدون مرتب
    case LeaveSettlement = 'leave_settlement';  // تصفيت اجازه
    case ReturnFromLeave = 'return_from_leave'; // عوده من اجازه

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    public static function labels(): array {
        return [
            self::Working->value    => 'يعمل',
            self::Vacation->value   => 'إجازة',
            self::SickLeave->value  => 'إجازة مرضية',
            self::Absent->value     => 'غياب',
            self::RemoteWork->value => 'عمل عن بعد',
            self::Suspended->value  => 'موقوف',
            self::Terminated->value => 'منتهى الخدمة',
            self::WorkSuspended->value   => 'موقوف عن العمل',
            self::Resignation->value     => 'استقاله',
            self::Transferred->value     => 'منقول',
            self::UnpaidLeave->value     => 'اجازه بدون مرتب',
            self::LeaveSettlement->value => 'تصفيت اجازه',
            self::ReturnFromLeave->value => 'عوده من اجازه',
        ];
    }

    public static function badge($value): string
    {
        return match ($value) {
            self::Working->value         => '<span class="badge bg-success">يعمل</span>',
            self::Vacation->value        => '<span class="badge bg-info">إجازة</span>',
            self::SickLeave->value       => '<span class="badge bg-warning">إجازة مرضية</span>',
            self::Absent->value          => '<span class="badge bg-danger">غياب</span>',
            self::RemoteWork->value      => '<span class="badge bg-primary">عمل عن بعد</span>',
            self::Suspended->value       => '<span class="badge bg-secondary">موقوف</span>',
            self::Terminated->value      => '<span class="badge bg-dark">منتهى الخدمة</span>',
            self::WorkSuspended->value   => '<span class="badge bg-danger">موقوف عن العمل</span>',
            self::Resignation->value     => '<span class="badge bg-dark">استقاله</span>',
            self::Transferred->value     => '<span class="badge bg-info">منقول</span>',
            self::UnpaidLeave->value     => '<span class="badge bg-warning">اجازه بدون مرتب</span>',
            self::LeaveSettlement->value => '<span class="badge bg-primary">تصفيت اجازه</span>',
            self::ReturnFromLeave->value => '<span class="badge bg-success">عوده من اجازه</span>',
            default                      => '<span class="badge bg-default">لم يتم التحديد</span>',
        };
    }
}
