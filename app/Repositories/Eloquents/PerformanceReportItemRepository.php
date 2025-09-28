<?php

namespace App\Repositories\Eloquents;

use App\Models\PerformanceReportItem;
use App\Repositories\Contracts\PerformanceReportItemRepositoryInterface;
use Illuminate\Http\Request;

class PerformanceReportItemRepository extends BaseRepository implements PerformanceReportItemRepositoryInterface
{
    protected $rules = [
        'name_ar'   => 'nullable|string|max:255',
        'name_en'   => 'nullable|string|max:255',
    ];

    public function __construct(PerformanceReportItem $model)
    {
        parent::__construct($model);
    }
}
