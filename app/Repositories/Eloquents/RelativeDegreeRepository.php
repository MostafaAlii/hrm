<?php

namespace App\Repositories\Eloquents;

use App\Models\RelativeDegree;
use App\Repositories\Contracts\RelativeDegreeRepositoryInterface;
use Illuminate\Http\Request;

class RelativeDegreeRepository extends BaseRepository implements RelativeDegreeRepositoryInterface {
    protected $rules = [
        'name_ar'   => 'required|string|max:255',
        'name_en'   => 'required|string|max:255',
        'insurance_percentage' => 'required|numeric|min:0|max:100',
    ];

    public function __construct(RelativeDegree $model)
    {
        parent::__construct($model);
    }

    protected function extraStoreFields(Request $request): array
    {
        return [
            'insurance_percentage' => $request->insurance_percentage,
        ];
    }

    protected function extraUpdateFields(Request $request, $id): array
    {
        return [
            'insurance_percentage' => $request->insurance_percentage,
        ];
    }
}