<?php

namespace App\Repositories\Eloquents;

use App\Models\BloodType;
use App\Repositories\Contracts\BloodTypeRepositoryInterface;

class BloodTypeRepository extends BaseRepository implements BloodTypeRepositoryInterface
{
    public function __construct(BloodType $model)
    {
        parent::__construct($model);
    }
}