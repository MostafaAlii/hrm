<?php
namespace App\Filters\EmployeeReport\Base;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
class JobCategoryFilter {
    public static function apply(Builder $query, Request $request): Builder {
        if ($request->has('filter_by_job_category') && $request->filter_by_job_category == 1) {
            if ($request->filled('job_category_id')) {
                $jobCategoryId = $request->job_category_id;
                $companyId = get_user_data()->company_id;
                $query->whereHas('jobCategory', function ($q) use ($jobCategoryId, $companyId) {
                    $q->where('id', $jobCategoryId)
                        ->where('company_id', $companyId)
                        ->where('is_active', 1);
                });
            }
        }
        return $query;
    }
}