<?php

namespace App\Repositories\Eloquents;

use App\Models\Specialization;
use App\Repositories\Contracts\SpecializationRepositoryInterface;
use Illuminate\Http\Request;

class SpecializationRepository extends BaseRepository implements SpecializationRepositoryInterface
{
    protected $rules = [
        'name_ar'   => 'nullable|string|max:255',
        'name_en'   => 'nullable|string|max:255',
    ];

    public function __construct(Specialization $model)
    {
        parent::__construct($model);
    }
}
