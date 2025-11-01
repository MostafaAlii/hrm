<?php

namespace App\Filters\EmployeeReport\Base;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class MilitaryStatusFilter
{
    public static function apply(Builder $query, Request $request): Builder
    {
        // نتأكد إن المستخدم فعّل الفلتر
        if ($request->has('filter_by_military_status') && $request->filter_by_military_status == 1) {
            if ($request->filled('military_status')) {
                $status = $request->military_status;
                // نفلتر الموظفين حسب حالة الخدمة العسكرية ونفس الشركة
                $query->whereHas('militaryService', function ($q) use ($status) {
                    $q->where('status', $status);
                });
            }
        }
        return $query;
    }
}
