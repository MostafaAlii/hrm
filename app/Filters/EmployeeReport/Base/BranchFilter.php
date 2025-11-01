<?php

namespace App\Filters\EmployeeReport\Base;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class BranchFilter
{
    public static function apply(Builder $query, Request $request): Builder
    {
        // نتأكد إن المستخدم فعّل فلتر جهه العمل
        if ($request->has('filter_by_branch') && $request->filter_by_branch == 1) {
            if ($request->filled('branch_id')) {
                $branchId = $request->branch_id;
                $companyId = get_user_data()->company_id;

                // نفلتر الموظفين حسب الفرع ونفس الشركة
                $query->whereHas('branch', function ($q) use ($branchId, $companyId) {
                    $q->where('id', $branchId)
                        ->where('company_id', $companyId)
                        ->where('is_active', 1); // لو تحب تضيف شرط النشاط
                });
            }
        }
        return $query;
    }
}
