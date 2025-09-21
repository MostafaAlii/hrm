<?php

namespace App\Repositories\Eloquents;

use App\Models\FamilyJob;
use App\Repositories\Contracts\FamilyJobRepositoryInterface;
use Illuminate\Http\Request;

class FamilyJobRepository extends BaseRepository implements FamilyJobRepositoryInterface
{
    protected $rules = [
        'name_ar'   => 'nullable|string|max:255',
        'name_en'   => 'nullable|string|max:255',
    ];

    public function __construct(FamilyJob $model)
    {
        parent::__construct($model);
    }

    protected function extraStoreFields(Request $request): array
    {
        return [
            'code'                => $request->code,
        ];
    }

    protected function extraUpdateFields(Request $request, $id): array
    {
        return [
            'code'                => $request->code,
        ];
    }
}