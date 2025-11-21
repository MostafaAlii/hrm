<?php

namespace App\DataTables\Dashboard\Admin;

use App\DataTables\Base\BaseDataTable;
use App\Models\Employee;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Utilities\Request as DataTableRequest;

class EmployeeLeaveAllocationDataTable extends BaseDataTable {
    public function __construct(DataTableRequest $request)
    {
        parent::__construct(new Employee);
        $this->request = $request;
    }

    public function dataTable($query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function (Employee $emp_record) {
                return view('dashboard.admin.employeeLeaveAllocations.btn.actions', compact('emp_record'));
            })
            ->editColumn('created_at', function (Employee $record) {
                return $this->formatTranslatedDate($record->created_at);
            })
            ->editColumn('updated_at', function (Employee $record) {
                return $this->formatTranslatedDate($record->updated_at);
            })
            ->addColumn('responsible', function (Employee $record) {
                $addedBy   = $record->addedBy?->name ? "✍️ " . $record->addedBy->name : null;
                $updatedBy = $record->updatedBy?->name ? "📝 " . $record->updatedBy->name : null;
                return $addedBy || $updatedBy ? implode(' | ', array_filter([$addedBy, $updatedBy])) : '-';
            })
            ->addColumn('level', function (Employee $record) {
                return $record->level?->name ?? '-';
            })
            ->addColumn('branch', function (Employee $record) {
                return $record->branch?->name ?? '-';
            })
            ->addColumn('department', function (Employee $record) {
                return $record->department?->name ?? '-';
            })
            ->addColumn('section', function (Employee $record) {
                return $record->section?->name ?? '-';
            })
            ->addColumn('job_category', function (Employee $record) {
                return $record->jobCategory?->name ?? '-';
            })
            ->rawColumns(['action', 'responsible', 'created_at', 'updated_at', 'level', 'branch', 'department', 'section', 'jobCategory']);
    }

    public function query(): QueryBuilder
    {
        $user = get_user_data()?->company_id;
        return Employee::with(['level', 'branch', 'department', 'section', 'jobCategory'])
            ->where('company_id', $user)
            ->latest();
    }

    public function getColumns(): array
    {
        return [
            ['name' => 'code', 'data' => 'code', 'title' => 'الكودى', 'orderable' => true, 'searchable' => true],
            ['name' => 'name_ar', 'data' => 'name_ar', 'title' => 'الاسم'],
            ['name' => 'level', 'data' => 'level', 'title' => 'المستوى', 'orderable' => false, 'searchable' => false],
            ['name' => 'branch', 'data' => 'branch', 'title' => 'جهه العمل', 'orderable' => false, 'searchable' => false],
            ['name' => 'department', 'data' => 'department', 'title' => 'الاداره', 'orderable' => false, 'searchable' => false],
            ['name' => 'section', 'data' => 'section', 'title' => 'القسم', 'orderable' => false, 'searchable' => false],
            ['name' => 'job_category', 'data' => 'job_category', 'title' => 'الوظيفه', 'orderable' => false, 'searchable' => false],
            ['name' => 'action', 'data' => 'action', 'title' => trans('dashboard/general.actions'), 'orderable' => false, 'searchable' => false],
        ];
    }
}
