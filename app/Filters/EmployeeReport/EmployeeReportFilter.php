<?php
namespace App\Filters\EmployeeReport;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use App\Filters\EmployeeReport\Base;
class EmployeeReportFilter { // بيانات العاملين
    protected Request $request;
    protected Builder $query;

    protected array $filters = [
        Base\CodeFilter::class,
        Base\HiringDateFilter::class,
        Base\ShiftTypeFilter::class,
    ];

    public function __construct(Request $request, Builder $query)
    {
        $this->request = $request;
        $this->query = $query;
    }

    public function apply(): Builder {
        foreach ($this->filters as $filter) {
            $this->query = $filter::apply($this->query, $this->request);
        }

        return $this->query;
    }
}
