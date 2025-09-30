<?php

namespace App\Repositories\Eloquents;

use App\Models\LicenseVariable;
use App\Repositories\Contracts\LicenseVariableRepositoryInterface;
use Illuminate\Http\Request;

class LicenseVariableRepository extends BaseRepository implements LicenseVariableRepositoryInterface
{
    protected $rules = [
        'name_ar'   => 'nullable|string|max:255',
        'name_en'   => 'nullable|string|max:255',
    ];

    public function __construct(LicenseVariable $model)
    {
        parent::__construct($model);
    }
}
