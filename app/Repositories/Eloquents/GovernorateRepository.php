<?php

namespace App\Repositories\Eloquents;

use App\Models\Governorate;
use App\Repositories\Contracts\GovernorateRepositoryInterface;
use Illuminate\Http\Request;

class GovernorateRepository extends BaseRepository implements GovernorateRepositoryInterface
{
    public function __construct(Governorate $model)
    {
        parent::__construct($model);
    }

    protected function extraStoreFields(Request $request): array
    {
        return [
            'transportation_allowance' => $request->transportation_allowance,
        ];
    }

    protected function extraUpdateFields(Request $request, $id): array
    {
        return [
            'transportation_allowance' => $request->transportation_allowance,
        ];
    }
}