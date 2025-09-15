<?php

namespace App\DataTables\Dashboard\Admin;

use App\DataTables\Base\BaseDataTable;
use App\Models\Department;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Utilities\Request as DataTableRequest;

class DepartmentDataTable extends BaseDataTable
{
    public function __construct(DataTableRequest $request)
    {
        parent::__construct(new Department);
        $this->request = $request;
    }

    public function dataTable($query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function (Department $department) {
                return view('dashboard.admin.departments.btn.actions', compact('department'));
            })
            ->editColumn('is_active_label', function (Department $department) {
                return $department->is_active_label;
            })
            ->editColumn('created_at', function (Department $department) {
                return $this->formatTranslatedDate($department->created_at);
            })
            ->editColumn('updated_at', function (Department $department) {
                return $this->formatTranslatedDate($department->updated_at);
            })
            ->addColumn('responsible', function (Department $department) {
                $addedBy   = $department->addedBy?->name ? "✍️ " . $department->addedBy->name : null;
                $updatedBy = $department->updatedBy?->name ? "📝 " . $department->updatedBy->name : null;
                return $addedBy || $updatedBy ? implode(' | ', array_filter([$addedBy, $updatedBy])) : '-';
            })
            ->rawColumns(['action', 'is_active_label', 'responsible', 'created_at', 'updated_at']);
    }

    public function query(): QueryBuilder
    {
        $user = get_user_data()?->company_id;
        return Department::where('company_id', $user)->latest();
    }

    public function getColumns(): array
    {
        return [
            ['name' => 'id', 'data' => 'id', 'title' => '#'],
            ['name' => 'name', 'data' => 'name', 'title' => trans('dashboard/branch.name')],
            ['name' => 'is_active', 'data' => 'is_active_label', 'title' => trans('dashboard/financial_year.is_active'), 'orderable' => false, 'searchable' => false],
            ['name' => 'phone', 'data' => 'phone', 'title' => trans('dashboard/branch.phone')],
            ['name' => 'responsible', 'data' => 'responsible', 'title' => trans('dashboard/financial_year.responsible'), 'orderable' => false, 'searchable' => false],
            ['name' => 'created_at', 'data' => 'created_at', 'title' => trans('dashboard/general.created_at')],
            ['name' => 'updated_at', 'data' => 'updated_at', 'title' => trans('dashboard/general.updated_at')],
            ['name' => 'action', 'data' => 'action', 'title' => trans('dashboard/general.actions'), 'orderable' => false, 'searchable' => false],
        ];
    }
}