<?php

namespace App\Filters\EmployeeReport\Base;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class ShiftTypeFilter {
    public static function apply(Builder $query, Request $request): Builder {
        if ($request->has('filter_by_shift_type') && $request->filter_by_shift_type == 1) {
            if ($request->filled('shift_type_id')) {
                $query->where('shift_type_id', $request->shift_type_id);
            }
        }
        return $query;
    }
}
