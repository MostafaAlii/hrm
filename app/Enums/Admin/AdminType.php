<?php

namespace App\Enums\Admin;

enum AdminType: string
{
    case OWNER = 'owner';
    case COMPANY_ADMIN = 'company_admin';
    case BRANCH_ADMIN = 'branch_admin';

    public static function label($value): string
    {
        return match ($value) {
            self::OWNER => trans('general.owner'),
            self::COMPANY_ADMIN => trans('general.company_admin'),
            self::BRANCH_ADMIN => trans('general.branch_admin'),
            default => trans('general.not_type_assigned'),
        };
    }

    public static function badge($value): string
    {
        return match ($value) {
            self::OWNER => '<span class="badge badge-primary">' . trans('general.owner') . '</span>',
            self::COMPANY_ADMIN => '<span class="badge badge-info">' . trans('general.company_admin') . '</span>',
            self::BRANCH_ADMIN => '<span class="badge badge-secondary">' . trans('general.branch_admin') . '</span>',
            default => '<span class="badge badge-default">' . trans('general.not_type_assigned') . '</span>',
        };
    }
}