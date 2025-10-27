<?php

namespace App\Repositories\Eloquents;

use App\Models\AllowanceVariable;
use App\Repositories\Contracts\AllowanceVariableRepositoryInterface;
use Illuminate\Http\Request;

class AllowanceVariableRepository extends BaseRepository implements AllowanceVariableRepositoryInterface {
    protected $rules = [
        //'code' => 'required|string|max:50|unique:allowance_variables,code',
        'name_ar' => 'required|string|max:255',
        'name_en' => 'nullable|string|max:255',
        'account_number' => 'nullable|string|max:50',
        'allowance_category_id' => 'nullable|exists:allowance_categories,id',
        'category_value' => 'nullable|string|max:255',
        'tax_system_code' => 'nullable|string|max:50',
        'has_min_limit' => 'nullable|boolean',
        'min_limit_value' => 'nullable|numeric|min:0',
        'max_limit_value' => 'nullable|numeric|min:0',
        'has_max_limit' => 'nullable|boolean',
        'is_taxable' => 'nullable|boolean',
        'is_health_insurance' => 'nullable|boolean',
        'is_active' => 'nullable|boolean',
    ];

    public function __construct(AllowanceVariable $model)
    {
        parent::__construct($model);
    }

    protected function extraData(string $context): array
    {
        $categories = \App\Models\AllowanceCategory::active()->get();
        return compact('categories');
    }

    protected function extraStoreFields(Request $request): array
    {
        return [
            'code' => $request->code,
            'name_ar' => $request->name_ar,
            'name_en' => $request->name_en,
            'account_number' => $request->account_number,
            'allowance_category_id' => $request->allowance_category_id,
            'category_value' => $request->category_value,
            'tax_system_code' => $request->tax_system_code,
            'has_min_limit' => $request->has('has_min_limit'),
            'has_max_limit' => $request->has('has_max_limit'),
            'min_limit_value' => $request->min_limit_value,
            'max_limit_value' => $request->max_limit_value,
            'is_taxable' => $request->has('is_taxable'),
            'is_health_insurance' => $request->has('is_health_insurance'),
            'is_active' => $request->has('is_active'),
        ];
    }

    protected function extraUpdateFields(Request $request, $id): array
    {
        $record = $this->model->findOrFail($id);

        $rules = $this->rules;
        //$rules['code'] = 'required|string|max:50|unique:allowance_variables,code,' . $id;

        $request->validate($rules);

        return [
            'code' => $request->code,
            'name_ar' => $request->name_ar,
            'name_en' => $request->name_en,
            'account_number' => $request->account_number,
            'allowance_category_id' => $request->allowance_category_id,
            'category_value' => $request->category_value,
            'tax_system_code' => $request->tax_system_code,
            'has_min_limit' => $request->has('has_min_limit'),
            'has_max_limit' => $request->has('has_max_limit'),
            'min_limit_value' => $request->min_limit_value,
            'max_limit_value' => $request->max_limit_value,
            'is_taxable' => $request->has('is_taxable'),
            'is_health_insurance' => $request->has('is_health_insurance'),
            'is_active' => $request->has('is_active'),
        ];
    }

    public function getTaxableVariables()
    {
        return $this->model->active()->taxable()->get();
    }

    public function getHealthInsuranceVariables()
    {
        return $this->model->active()->healthInsurance()->get();
    }

    public function getActiveVariables()
    {
        return $this->model->active()->get();
    }
}
