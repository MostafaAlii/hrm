<?php

namespace App\Filters\EmployeeReport\Base;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class HiringDateFilter {
    public static function apply(Builder $query, Request $request): Builder {
        if ($request->has('filter_by_hiring_date') && $request->filter_by_hiring_date == 1) {
            if ($request->filled('hiring_date_from')) {
                $query->whereDate('hiring_date', '>=', $request->hiring_date_from);
            }
            if ($request->filled('hiring_date_to')) {
                $query->whereDate('hiring_date', '<=', $request->hiring_date_to);
            }
        }
        return $query;
    }
}
