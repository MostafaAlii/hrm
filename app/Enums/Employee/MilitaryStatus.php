<?php

namespace App\Enums\Employee;

enum MilitaryStatus: string {
    case UNDEFINED    = 'undefined';
    case COMPLETED    = 'completed';
    case POSTPONED    = 'postponed';
    case ON_DEMAND    = 'on_demand';
    case NOT_CALLED   = 'not_called';
    case EXEMPTED     = 'exempted';
    case TEMP_EXEMPT  = 'temp_exempt';

    public function label(): string
    {
        return match ($this) {
            self::UNDEFINED   => 'لم تحدد',
            self::COMPLETED   => 'أدى الخدمة',
            self::POSTPONED   => 'مؤجل',
            self::ON_DEMAND   => 'تحت الطلب',
            self::NOT_CALLED  => 'لم يصبه الدور',
            self::EXEMPTED    => 'معاف',
            self::TEMP_EXEMPT => 'معاف مؤقت',
        };
    }

    public static function options(): array
    {
        return array_map(
            fn($status) => [
                'value' => $status->value,
                'label' => $status->label()
            ],
            self::cases()
        );
    }
}
