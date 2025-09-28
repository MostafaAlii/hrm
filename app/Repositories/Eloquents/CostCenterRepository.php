<?php

namespace App\Repositories\Eloquents;

use App\Models\CostCenter;
use App\Repositories\Contracts\CostCenterRepositoryInterface;
use Illuminate\Http\Request;

class CostCenterRepository extends BaseRepository implements CostCenterRepositoryInterface
{
    protected $rules = [
        'name_ar'   => 'nullable|string|max:255',
        'name_en'   => 'nullable|string|max:255',
    ];

    public function __construct(CostCenter $model)
    {
        parent::__construct($model);
    }
}