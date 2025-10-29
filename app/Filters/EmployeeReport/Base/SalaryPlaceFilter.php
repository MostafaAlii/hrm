<?php
namespace App\Filters\EmployeeReport\Base;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
class SalaryPlaceFilter {
    public static function apply(Builder $query, Request $request): Builder {
        if ($request->has('filter_by_salary_place') && $request->filter_by_salary_place == 1) {
            if ($request->filled('salary_place_id')) {
                $query->where('salary_place_id', $request->salary_place_id);
            }
        }
        return $query;
    }
}
