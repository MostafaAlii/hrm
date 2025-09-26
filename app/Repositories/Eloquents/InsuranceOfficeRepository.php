<?php

namespace App\Repositories\Eloquents;

use App\Models\InsuranceOffice;
use Illuminate\Http\Request;
use App\Repositories\Contracts\InsuranceOfficeRepositoryInterface;
class InsuranceOfficeRepository extends BaseRepository implements InsuranceOfficeRepositoryInterface {
    protected $rules = [
        'name_ar'   => 'nullable|string|max:255',
        'name_en'   => 'nullable|string|max:255',
        'code'      => 'nullable|string|max:255|unique:insurance_offices,code',
    ];

    public function __construct(InsuranceOffice $model)
    {
        parent::__construct($model);
    }

    protected function extraStoreFields(Request $request): array
    {
        return [
            'code' => $request->code,
        ];
    }

    protected function extraUpdateFields(Request $request, $id): array
    {
        return [
            'code' => $request->code,
        ];
    }
}
