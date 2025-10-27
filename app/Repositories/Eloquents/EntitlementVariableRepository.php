<?php

namespace App\Repositories\Eloquents;

use App\Models\EntitlementVariable;
use App\Repositories\Contracts\EntitlementVariableRepositoryInterface;
use Illuminate\Http\Request;

class EntitlementVariableRepository extends BaseRepository implements EntitlementVariableRepositoryInterface
{
    protected $rules = [
        //'code' => 'required|string|max:50|unique:entitlement_variables,code',
        'name_ar' => 'required|string|max:255',
        'name_en' => 'nullable|string|max:255',
        'account_number' => 'nullable|string|max:50',
        'entitlement_category_id' => 'nullable|exists:entitlement_variable_categories,id',
        'category_value' => 'nullable|string|max:255',
        'revenue_type_id' => 'nullable|exists:revenue_types,id',
        'nature' => 'required|in:fixed,monthly',
        'affected_by_deductions' => 'nullable|boolean',
        'not_affected_by_work_days' => 'nullable|boolean',
        'not_affect_entitlements' => 'nullable|boolean',
        'is_health_insurance' => 'nullable|boolean',
        'is_taxable' => 'nullable|boolean',
        'tax_exempt_amount' => 'nullable|numeric|min:0',
        'max_taxable_amount' => 'nullable|numeric|min:0',
        'has_min_limit' => 'nullable|boolean',
        'min_limit_value' => 'nullable|numeric|min:0',
        'has_max_limit' => 'nullable|boolean',
        'max_limit_value' => 'nullable|numeric|min:0',
        'is_active' => 'nullable|boolean',
        'entitlement_type_relation_id' => 'nullable|exists:entitlement_type_relations,id'
    ];

    public function __construct(EntitlementVariable $model)
    {
        parent::__construct($model);
    }

    protected function extraData(string $context): array
    {
        $categories = \App\Models\EntitlementVariableCategory::active()->get();
        $revenueTypes = \App\Models\RevenueType::active()->get();
        $entitlementRelations = \App\Models\EntitlementTypeRelation::where('is_active', true)->get();
        return compact('categories', 'revenueTypes', 'entitlementRelations');
    }

    protected function extraStoreFields(Request $request): array
    {
        return [
            'code' => $request->code,
            'name_ar' => $request->name_ar,
            'name_en' => $request->name_en,
            'account_number' => $request->account_number,
            'entitlement_category_id' => $request->entitlement_category_id,
            'category_value' => $request->category_value,
            'entitlement_type_relation_id' => $request->entitlement_type_relation_id,
            'revenue_type_id' => $request->revenue_type_id,
            'nature' => $request->nature,
            'affected_by_deductions' => $request->has('affected_by_deductions'),
            'not_affected_by_work_days' => $request->has('not_affected_by_work_days'),
            'not_affect_entitlements' => $request->has('not_affect_entitlements'),
            'is_health_insurance' => $request->has('is_health_insurance'),
            'is_taxable' => $request->has('is_taxable'),
            'tax_exempt_amount' => $request->tax_exempt_amount,
            'max_taxable_amount' => $request->max_taxable_amount,
            'has_min_limit' => $request->has('has_min_limit'),
            'min_limit_value' => $request->min_limit_value,
            'has_max_limit' => $request->has('has_max_limit'),
            'max_limit_value' => $request->max_limit_value,
            'is_active' => $request->has('is_active'),
        ];
    }

    protected function extraUpdateFields(Request $request, $id): array
    {
        $record = $this->model->findOrFail($id);

        $rules = $this->rules;
        //$rules['code'] = 'required|string|max:50|unique:entitlement_variables,code,' . $id;

        $request->validate($rules);

        return [
            'code' => $request->code,
            'name_ar' => $request->name_ar,
            'name_en' => $request->name_en,
            'account_number' => $request->account_number,
            'entitlement_category_id' => $request->entitlement_category_id,
            'category_value' => $request->category_value,
            'entitlement_type_relation_id' => $request->entitlement_type_relation_id,
            'revenue_type_id' => $request->revenue_type_id,
            'nature' => $request->nature,
            'affected_by_deductions' => $request->has('affected_by_deductions'),
            'not_affected_by_work_days' => $request->has('not_affected_by_work_days'),
            'not_affect_entitlements' => $request->has('not_affect_entitlements'),
            'is_health_insurance' => $request->has('is_health_insurance'),
            'is_taxable' => $request->has('is_taxable'),
            'tax_exempt_amount' => $request->tax_exempt_amount,
            'max_taxable_amount' => $request->max_taxable_amount,
            'has_min_limit' => $request->has('has_min_limit'),
            'min_limit_value' => $request->min_limit_value,
            'has_max_limit' => $request->has('has_max_limit'),
            'max_limit_value' => $request->max_limit_value,
            'is_active' => $request->has('is_active'),
        ];
    }

    public function getFixedVariables()
    {
        return $this->model->active()->where('nature', 'fixed')->get();
    }

    public function getMonthlyVariables()
    {
        return $this->model->active()->where('nature', 'monthly')->get();
    }

    public function getTaxableVariables()
    {
        return $this->model->active()->taxable()->get();
    }
}
