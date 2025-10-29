<?php

namespace App\Filters\EmployeeReport\Base;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class TaxFilter
{
    public static function apply(Builder $query, Request $request): Builder
    {
        // نتأكد إن المستخدم فعل فلتر الضريبة
        if ($request->has('filter_by_tax') && $request->filter_by_tax == 1) {
            if ($request->filled('is_taxable')) {
                $isTaxable = $request->is_taxable;
                $companyId = get_user_data()->company_id;
                if ($isTaxable == 1) {
                    // الموظفين اللي يخضعوا للضريبة
                    $query->whereHas('salaryBasics', function ($q) use ($companyId) {
                        $q->where('is_taxable', 1)->where('company_id', $companyId);
                    });
                } else {
                    // الموظفين اللي لا يخضعوا للضريبة:
                    // 1. اللي عندهم سجل و is_taxable = 0 أو null
                    // 2. اللي ملوش أي سجل في salaryBasics لنفس الشركة
                    $query->where(function ($q) use ($companyId) {
                        $q->whereDoesntHave('salaryBasics', function ($q2) use ($companyId) {
                            $q2->where('is_taxable', 1)
                                ->where('company_id', $companyId);
                        });
                    });
                }
            }
        }
        return $query;
    }
}
