<?php

namespace App\Repositories\Eloquents;

use App\Models\Grade;
use App\Repositories\Contracts\GradeRepositoryInterface;
use Illuminate\Http\Request;

class GradeRepository extends BaseRepository implements GradeRepositoryInterface
{
    protected $rules = [
        'name_ar'   => 'nullable|string|max:255',
        'name_en'   => 'nullable|string|max:255',
    ];

    public function __construct(Grade $model)
    {
        parent::__construct($model);
    }
}