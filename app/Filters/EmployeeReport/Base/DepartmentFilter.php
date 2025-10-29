<?php

namespace App\Filters\EmployeeReport\Base;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class DepartmentFilter
{
    public static function apply(Builder $query, Request $request): Builder
    {
        if ($request->has('filter_by_department') && $request->filter_by_department == 1) {
            if ($request->filled('department_id')) {
                $query->where('department_id', $request->department_id);
            }
        }
        return $query;
    }
}
