<?php

namespace App\Repositories\Eloquents;

use App\Models\Country;
use App\Repositories\Contracts\CountryRepositoryInterface;

class CountryRepository extends BaseRepository implements CountryRepositoryInterface
{
    public function __construct(Country $model)
    {
        parent::__construct($model);
    }
}
