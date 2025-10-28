<?php
namespace App\Filters\EmployeeReport\Base;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
class CodeFilter {
    public static function apply(Builder $query, Request $request): Builder {
        if ($request->has('filter_by_code') && $request->filter_by_code == 1) {
            if ($request->filled('code_from')) {
                $query->where('code', '>=', $request->code_from);
            }
            if ($request->filled('code_to')) {
                $query->where('code', '<=', $request->code_to);
            }
        }
        return $query;
    }
}