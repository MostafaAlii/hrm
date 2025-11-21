<?php

namespace App\DataTables\Dashboard\Admin;
use App\DataTables\Base\BaseDataTable;
use App\Models\EmployeeLeaveAllocation;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
class EmployeeShowLeaveAllocationDataTable extends BaseDataTable {
    protected int $employeeId;
    public function __construct($employeeId) {
        parent::__construct(new EmployeeLeaveAllocation);
        $this->employeeId = $employeeId;
    }

    public function dataTable($query): EloquentDataTable {
        return (new EloquentDataTable($query))
            ->addColumn('code', fn($r) => $r->leaveVariable?->code)
            ->addColumn('leave_variable', fn($r) => $r->leaveVariable?->name_ar . ' (' . $r->leaveVariable?->symbol . ')')
            ->editColumn('allocated_balance', fn($r) => number_format($r->allocated_balance, 2))
            ->editColumn('previous_balance', fn($r) => number_format($r->previous_balance, 2))
            ->editColumn('is_year', fn($r) => $r->is_year ? '<i class="fa fa-check text-success"></i>' : '<i class="fa fa-times text-danger"></i>')
            ->editColumn('is_break_year', fn($r) => $r->is_break_year ? '<i class="fa fa-check text-success"></i>' : '<i class="fa fa-times text-danger"></i>')
            ->editColumn('year', fn($r) => $r->year ?? '-')
            ->addColumn('action', fn($r) => view('dashboard.admin.employeeLeaveAllocations.btn.show.btn.actions', compact('r')))
            ->addColumn('current_balance', fn($r) => number_format(($r->allocated_balance + $r->previous_years_balance), 2)) // <-- الرصيد الحالى
            ->rawColumns(['is_year', 'is_break_year', 'code', 'current_balance']);
    }

    public function query(): QueryBuilder
    {
        return EmployeeLeaveAllocation::with('leaveVariable')
            ->where('employee_id', $this->employeeId)
            ->orderByDesc('id');
    }

    public function getColumns(): array
    {
        return [

            ['name' => 'code', 'data' => 'code', 'title' => 'الكود', 'orderable' => false, 'searchable' => false],
            ['name' => 'leave_variable', 'data' => 'leave_variable', 'title' => 'نوع الإجازة'],
            ['name' => 'year', 'data' => 'year', 'title' => 'العام'],
            ['name' => 'allocated_balance', 'data' => 'allocated_balance', 'title' => 'الرصيد المخصص'],
            ['name' => 'previous_years_balance', 'data' => 'previous_years_balance', 'title' => 'رصيد سنوات سابقة'],
            ['name' => 'current_balance', 'data' => 'current_balance', 'title' => 'الرصيد الحالى', 'orderable' => false, 'searchable' => false],
            ['name' => 'action', 'data' => 'action', 'title' => 'الإجراءات', 'orderable' => false, 'searchable' => false],
        ];
    }
}
