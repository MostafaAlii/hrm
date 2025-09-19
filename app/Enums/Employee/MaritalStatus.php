<?php

namespace App\Enums\Employee;

enum MaritalStatus: string {
    case SINGLE   = 'single';
    case MARRIED  = 'married';
    case DIVORCED = 'divorced';
    case WIDOWED  = 'widowed';

    public function label(): string
    {
        return match ($this) {
            self::SINGLE   => 'أعزب',
            self::MARRIED  => 'متزوج',
            self::DIVORCED => 'مطلّق',
            self::WIDOWED  => 'أرمل',
        };
    }

    public static function options(): array
    {
        return array_map(fn($status) => [
            'value' => $status->value,
            'label' => $status->label()
        ], self::cases());
    }
}
