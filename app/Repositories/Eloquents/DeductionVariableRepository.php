<?php

namespace App\Repositories\Eloquents;

use App\Models\DeductionVariable;
use App\Repositories\Contracts\DeductionVariableRepositoryInterface;
use Illuminate\Http\Request;

class DeductionVariableRepository extends BaseRepository implements DeductionVariableRepositoryInterface
{
    protected $rules = [
        //'code' => 'required|string|max:50|unique:deduction_variables,code',
        'name_ar' => 'required|string|max:255',
        'name_en' => 'nullable|string|max:255',
        'account_number' => 'nullable|string|max:50',
        'deduction_category_id' => 'nullable|exists:deduction_variable_categories,id',
        'entitlement_type_relation_id' => 'nullable|exists:entitlement_type_relations,id',
        'tax_system_code' => 'nullable|string|max:50',
        'value' => 'nullable|numeric|min:0',
        'is_fixed' => 'nullable|boolean',
        'is_monthly' => 'nullable|boolean',
        'is_taxable' => 'nullable|boolean',
        'affects_bonus' => 'nullable|boolean',
        'not_affect_salary' => 'nullable|boolean',
        'deduction_type_id' => 'nullable|exists:deduction_types,id',
        'is_active' => 'nullable|boolean',
    ];

    public function __construct(DeductionVariable $model)
    {
        parent::__construct($model);
    }

    protected function extraData(string $context): array
    {
        $categories = \App\Models\DeductionVariableCategory::where('is_active', true)->get();
        $entitlementRelations = \App\Models\EntitlementTypeRelation::where('is_active', true)->get();
        $deductionTypes = \App\Models\DeductionType::where('is_active', true)->get();
        return compact('categories', 'entitlementRelations', 'deductionTypes');
    }

    protected function extraStoreFields(Request $request): array
    {
        return [
            'code' => $request->code,
            'name_ar' => $request->name_ar,
            'name_en' => $request->name_en,
            'account_number' => $request->account_number,
            'deduction_category_id' => $request->deduction_category_id,
            'entitlement_type_relation_id' => $request->entitlement_type_relation_id,
            'tax_system_code' => $request->tax_system_code,
            'is_fixed' => $request->has('is_fixed'),
            'value' => $request->value,
            'is_monthly' => $request->has('is_monthly'),
            'is_taxable' => $request->has('is_taxable'),
            'affects_bonus' => $request->has('affects_bonus'),
            'not_affect_salary' => $request->has('not_affect_salary'),
            'deduction_type_id' => $request->deduction_type_id,
            'is_active' => $request->has('is_active'),
        ];
    }

    protected function extraUpdateFields(Request $request, $id): array
    {
        $record = $this->model->findOrFail($id);

        $rules = $this->rules;
        $rules['code'] = 'required|string|max:50|unique:deduction_variables,code,' . $id;

        $request->validate($rules);

        return [
            'code' => $request->code,
            'name_ar' => $request->name_ar,
            'name_en' => $request->name_en,
            'value' => $request->value,
            'account_number' => $request->account_number,
            'deduction_category_id' => $request->deduction_category_id,
            'entitlement_type_relation_id' => $request->entitlement_type_relation_id,
            'tax_system_code' => $request->tax_system_code,
            'is_fixed' => $request->has('is_fixed'),
            'is_monthly' => $request->has('is_monthly'),
            'is_taxable' => $request->has('is_taxable'),
            'affects_bonus' => $request->has('affects_bonus'),
            'not_affect_salary' => $request->has('not_affect_salary'),
            'deduction_type_id' => $request->deduction_type_id,
            'is_active' => $request->has('is_active'),
        ];
    }

    public function getFixedVariables()
    {
        return $this->model->active()->where('is_fixed', true)->get();
    }

    public function getMonthlyVariables()
    {
        return $this->model->active()->where('is_monthly', true)->get();
    }

    public function getTaxableVariables()
    {
        return $this->model->active()->taxable()->get();
    }
}
