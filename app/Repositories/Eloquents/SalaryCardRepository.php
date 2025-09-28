<?php

namespace App\Repositories\Eloquents;

use App\Models\SalaryCard;
use App\Repositories\Contracts\SalaryCardRepositoryInterface;
use Illuminate\Http\Request;

class SalaryCardRepository extends BaseRepository implements SalaryCardRepositoryInterface
{
    protected $rules = [
        'name_ar'   => 'nullable|string|max:255',
        'name_en'   => 'nullable|string|max:255',
    ];

    public function __construct(SalaryCard $model)
    {
        parent::__construct($model);
    }
}
