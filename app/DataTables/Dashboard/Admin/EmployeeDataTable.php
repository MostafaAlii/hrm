<?php

namespace App\DataTables\Dashboard\Admin;

use App\DataTables\Base\BaseDataTable;
use App\Models\Employee;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Utilities\Request as DataTableRequest;

class EmployeeDataTable extends BaseDataTable {
    public function __construct(DataTableRequest $request)
    {
        parent::__construct(new Employee);
        $this->request = $request;
    }

    public function dataTable($query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function (Employee $employee) {
                return view('dashboard.admin.employees.btn.actions', compact('employee'));
            })
            ->editColumn('is_active_label', function (Employee $employee) {
                return $employee->is_active_label;
            })
            ->editColumn('created_at', function (Employee $employee) {
                return $this->formatTranslatedDate($employee->created_at);
            })
            ->editColumn('updated_at', function (Employee $employee) {
                return $this->formatTranslatedDate($employee->updated_at);
            })
            ->addColumn('responsible', function (Employee $employee) {
                $addedBy   = $employee->addedBy?->name ? "✍️ " . $employee->addedBy->name : null;
                $updatedBy = $employee->updatedBy?->name ? "📝 " . $employee->updatedBy->name : null;
                return $addedBy || $updatedBy ? implode(' | ', array_filter([$addedBy, $updatedBy])) : '-';
            })
            ->addColumn('level', function (Employee $employee) {
                return $employee->level?->name ?? '-';
            })
            ->addColumn('branch', function (Employee $employee) {
                return $employee->branch?->name ?? '-';
            })
            ->addColumn('department', function (Employee $employee) {
                return $employee->department?->name ?? '-';
            })
            ->addColumn('section', function (Employee $employee) {
                return $employee->section?->name ?? '-';
            })
            ->addColumn('job_category', function (Employee $employee) {
                return $employee->jobCategory?->name ?? '-';
            })
            ->addColumn('salary_place', function (Employee $employee) {
                return $employee->salaryPlace?->name ?? '-';
            })
            ->rawColumns(['action', 'is_active_label', 'responsible', 'created_at', 'updated_at', 'level', 'branch', 'department', 'section', 'jobCategory', 'salaryPlace']);
    }

    public function query(): QueryBuilder
    {
        $user = get_user_data()?->company_id;
        return Employee::with(['level', 'branch', 'department', 'section', 'jobCategory', 'salaryPlace'])
            ->where('company_id', $user)
            ->latest();
    }

    public function getColumns(): array
    {
        return [
            ['name' => 'id', 'data' => 'id', 'title' => '#'],
            ['name' => 'name', 'data' => 'name', 'title' => 'الاسم'],
            ['name' => 'level', 'data' => 'level', 'title' => 'المستوى', 'orderable' => false, 'searchable' => false],
            ['name' => 'branch', 'data' => 'branch', 'title' => 'جهه العمل', 'orderable' => false, 'searchable' => false],
            ['name' => 'department', 'data' => 'department', 'title' => 'الاداره', 'orderable' => false, 'searchable' => false],
            ['name' => 'section', 'data' => 'section', 'title' => 'القسم', 'orderable' => false, 'searchable' => false],
            ['name' => 'job_category', 'data' => 'job_category', 'title' => 'الوظيفه', 'orderable' => false, 'searchable' => false],
            ['name' => 'salary_place', 'data' => 'salary_place', 'title' => ' استلام المرتب', 'orderable' => false, 'searchable' => false],
            ['name' => 'is_active', 'data' => 'is_active_label', 'title' => trans('dashboard/financial_year.is_active'), 'orderable' => false, 'searchable' => false],
            ['name' => 'responsible', 'data' => 'responsible', 'title' => trans('dashboard/financial_year.responsible'), 'orderable' => false, 'searchable' => false],
            ['name' => 'created_at', 'data' => 'created_at', 'title' => trans('dashboard/general.created_at')],
            ['name' => 'updated_at', 'data' => 'updated_at', 'title' => trans('dashboard/general.updated_at')],
            ['name' => 'action', 'data' => 'action', 'title' => trans('dashboard/general.actions'), 'orderable' => false, 'searchable' => false],
        ];
    }
}
