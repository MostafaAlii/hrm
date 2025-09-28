<?php

namespace App\Repositories\Eloquents;

use App\Models\EmploymentDocument;
use App\Repositories\Contracts\EmploymentDocumentRepositoryInterface;
use Illuminate\Http\Request;

class EmploymentDocumentRepository extends BaseRepository implements EmploymentDocumentRepositoryInterface
{
    protected $rules = [
        'name_ar'   => 'nullable|string|max:255',
        'name_en'   => 'nullable|string|max:255',
    ];

    public function __construct(EmploymentDocument $model)
    {
        parent::__construct($model);
    }
}
