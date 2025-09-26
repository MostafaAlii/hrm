<?php

namespace App\Repositories\Eloquents;

use App\Models\InsuranceRegion;
use App\Repositories\Contracts\InsuranceRegionRepositoryInterface;
use Illuminate\Http\Request;
class InsuranceRegionRepository extends BaseRepository implements InsuranceRegionRepositoryInterface
{
    protected $rules = [
        'name_ar'   => 'nullable|string|max:255',
        'name_en'   => 'nullable|string|max:255',
        //'code'      => 'nullable|string|max:255|unique:insurance_regions,code',
    ];

    public function __construct(InsuranceRegion $model)
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
