<?php

namespace App\Filters\EmployeeReport\Base;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class WorkingStatusFilter
{
    public static function apply(Builder $query, Request $request): Builder
    {
        if ($request->has('filter_by_working_status') && $request->filter_by_working_status == 1) {
            if ($request->filled('working_status')) {
                $query->where('working_status', $request->working_status);
            }
        }
        return $query;
    }
}
