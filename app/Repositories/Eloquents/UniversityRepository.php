<?php

namespace App\Repositories\Eloquents;

use App\Models\University;
use App\Repositories\Contracts\UniversityRepositoryInterface;
use Illuminate\Http\Request;

class UniversityRepository extends BaseRepository implements UniversityRepositoryInterface
{
    protected $rules = [
        'name_ar'   => 'nullable|string|max:255',
        'name_en'   => 'nullable|string|max:255',
    ];

    public function __construct(University $model)
    {
        parent::__construct($model);
    }
}
