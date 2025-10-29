<?php
namespace App\Filters\EmployeeReport\Base;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
class IsInsuredFilter {
    public static function apply(Builder $query, Request $request): Builder {
        if ($request->has('filter_by_insurance') && $request->filter_by_insurance == 1) {
            if ($request->filled('is_insured')) {
                $isInsured = $request->is_insured;
                $companyId = get_user_data()->company_id;
                if ($isInsured == 1) {
                    $query->whereHas('insurances', function ($q) use ($companyId) {
                        $q->where('is_insured', 1)->where('company_id', $companyId);
                    });
                } else {
                    $query->whereDoesntHave('insurances', function ($q) use ($companyId) {
                        $q->where('is_insured', 1)->where('company_id', $companyId);
                    });
                }
            }
        }
        return $query;
    }
}
