<?php

namespace App\Filters\EmployeeReport\Base;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class SectionFilter {
    public static function apply(Builder $query, Request $request): Builder {
        if ($request->has('filter_by_section') && $request->filter_by_section == 1) {
            if ($request->filled('section_id')) {
                $query->where('section_id', $request->section_id);
            }
        }
        return $query;
    }
}
