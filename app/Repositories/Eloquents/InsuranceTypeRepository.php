<?php

namespace App\Repositories\Eloquents;

use App\Models\InsuranceType;
use App\Repositories\Contracts\InsuranceTypeRepositoryInterface;
use Illuminate\Http\Request;

class InsuranceTypeRepository extends BaseRepository implements InsuranceTypeRepositoryInterface
{
    protected $rules = [
        'name_ar'             => 'nullable|string|max:255',
        'name_en'             => 'nullable|string|max:255',
        //'code'                => 'nullable|string|max:255|unique:insurance_types,code',
        'employee_percentage' => 'required|numeric|min:0|max:100',
        'company_percentage'  => 'required|numeric|min:0|max:100',
    ];

    public function __construct(InsuranceType $model)
    {
        parent::__construct($model);
    }

    protected function extraStoreFields(Request $request): array
    {
        return [
            'code'                => $request->code,
            'employee_percentage' => $request->employee_percentage,
            'company_percentage'  => $request->company_percentage,
        ];
    }

    protected function extraUpdateFields(Request $request, $id): array
    {
        return [
            'code'                => $request->code,
            'employee_percentage' => $request->employee_percentage,
            'company_percentage'  => $request->company_percentage,
        ];
    }
}
