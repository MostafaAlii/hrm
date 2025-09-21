<?php

namespace App\DataTables\Dashboard\Admin;

use App\DataTables\Base\BaseDataTable;
use App\Models\FamilyJob;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Utilities\Request as DataTableRequest;

class FamilyJobDataTable extends BaseDataTable
{
    public function __construct(DataTableRequest $request)
    {
        parent::__construct(new FamilyJob);
        $this->request = $request;
    }

    public function dataTable($query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function (FamilyJob $job) {
                return view('dashboard.admin.family_jobs.btn.actions', compact('job'));
            })
            ->editColumn('created_at', fn(FamilyJob $job) => $this->formatTranslatedDate($job->created_at))
            ->editColumn('updated_at', fn(FamilyJob $job) => $this->formatTranslatedDate($job->updated_at))
            ->addColumn('responsible', function (FamilyJob $job) {
                $addedBy   = $job->addedBy?->name ? "✍️ " . $job->addedBy->name : null;
                $updatedBy = $job->updatedBy?->name ? "📝 " . $job->updatedBy->name : null;
                return $addedBy || $updatedBy ? implode(' | ', array_filter([$addedBy, $updatedBy])) : '-';
            })
            ->rawColumns(['action', 'responsible', 'created_at', 'updated_at']);
    }

    public function query(): QueryBuilder
    {
        $user = get_user_data()?->company_id;
        return FamilyJob::where('company_id', $user)->latest();
    }

    public function getColumns(): array
    {
        return [
            ['name' => 'id', 'data' => 'id', 'title' => '#'],
            ['name' => 'code', 'data' => 'code', 'title' => trans('dashboard/family_job.code')],
            ['name' => 'name_ar', 'data' => 'name_ar', 'title' => trans('dashboard/family_job.name_ar')],
            ['name' => 'name_en', 'data' => 'name_en', 'title' => trans('dashboard/family_job.name_en')],
            ['name' => 'name_en', 'data' => 'name_en', 'title' => trans('dashboard/family_job.name_en')],
            ['name' => 'responsible', 'data' => 'responsible', 'title' => trans('dashboard/financial_year.responsible')],
            ['name' => 'created_at', 'data' => 'created_at', 'title' => trans('dashboard/general.created_at')],
            ['name' => 'updated_at', 'data' => 'updated_at', 'title' => trans('dashboard/general.updated_at')],
            ['name' => 'action', 'data' => 'action', 'title' => trans('dashboard/general.actions'), 'orderable' => false, 'searchable' => false],
        ];
    }
}
