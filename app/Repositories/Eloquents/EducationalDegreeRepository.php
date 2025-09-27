<?php

namespace App\Repositories\Eloquents;

use App\Models\EducationalDegree;
use App\Repositories\Contracts\EducationalDegreeRepositoryInterface;
use Illuminate\Http\Request;

class EducationalDegreeRepository extends BaseRepository implements EducationalDegreeRepositoryInterface
{
    protected $rules = [
        'name_ar'   => 'nullable|string|max:255',
        'name_en'   => 'nullable|string|max:255',
    ];

    public function __construct(EducationalDegree $model)
    {
        parent::__construct($model);
    }
}