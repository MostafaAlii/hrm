<?php

namespace App\DataTables\Dashboard\Admin;

use App\DataTables\Base\BaseDataTable;
use App\Models\{JobCategory,Department};
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Utilities\Request as DataTableRequest;

class JobCategoryDataTable extends BaseDataTable
{
    public function __construct(DataTableRequest $request)
    {
        parent::__construct(new JobCategory);
        $this->request = $request;
    }

    public function dataTable($query): EloquentDataTable {
        $departments = Department::active()->get();
        return (new EloquentDataTable($query))
            ->addColumn('action', function (JobCategory $jobCategory) use ($departments) {
                return view('dashboard.admin.jobCategories.btn.actions', compact(['jobCategory', 'departments']));
            })
            ->editColumn('is_active_label', function (JobCategory $jobCategory) {
                return $jobCategory->is_active_label;
            })
            ->editColumn('created_at', function (JobCategory $jobCategory) {
                return $this->formatTranslatedDate($jobCategory->created_at);
            })
            ->editColumn('updated_at', function (JobCategory $jobCategory) {
                return $this->formatTranslatedDate($jobCategory->updated_at);
            })
            ->addColumn('responsible', function (JobCategory $jobCategory) {
                $addedBy   = $jobCategory->addedBy?->name ? "✍️ " . $jobCategory->addedBy->name : null;
                $updatedBy = $jobCategory->updatedBy?->name ? "📝 " . $jobCategory->updatedBy->name : null;
                return $addedBy || $updatedBy ? implode(' | ', array_filter([$addedBy, $updatedBy])) : '-';
            })
            ->editColumn('department_id', function (JobCategory $jobCategory) {
                return $jobCategory->department?->name ?? '-';
            })
            ->editColumn('section_id', function (JobCategory $jobCategory) {
                return $jobCategory->section?->name ?? '-';
            })
            ->rawColumns(['action', 'is_active_label', 'responsible', 'created_at', 'updated_at', 'department_id', 'section_id']);
    }

    public function query(): QueryBuilder
    {
        $user = get_user_data()?->company_id;
        return JobCategory::where('company_id', $user)->latest();
    }

    public function getColumns(): array
    {
        return [
            ['name' => 'id', 'data' => 'id', 'title' => '#'],
            ['name' => 'name', 'data' => 'name', 'title' => trans('dashboard/branch.name')],
            ['name' => 'is_active', 'data' => 'is_active_label', 'title' => trans('dashboard/financial_year.is_active'), 'orderable' => false, 'searchable' => false],
            ['name' => 'responsible', 'data' => 'responsible', 'title' => trans('dashboard/financial_year.responsible'), 'orderable' => false, 'searchable' => false],
            ['name' => 'department_id', 'data' => 'department_id', 'title' => 'الاداره', 'orderable' => false, 'searchable' => false],
            ['name' => 'section_id', 'data' => 'section_id', 'title' => 'القسم', 'orderable' => false, 'searchable' => false],
            ['name' => 'created_at', 'data' => 'created_at', 'title' => trans('dashboard/general.created_at')],
            ['name' => 'updated_at', 'data' => 'updated_at', 'title' => trans('dashboard/general.updated_at')],
            ['name' => 'action', 'data' => 'action', 'title' => trans('dashboard/general.actions'), 'orderable' => false, 'searchable' => false],
        ];
    }
}