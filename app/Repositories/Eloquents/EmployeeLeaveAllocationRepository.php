<?php

namespace App\Repositories\Eloquents;

use App\Models\{EmployeeLeaveAllocation,Employee, LeaveVariable};
use App\Repositories\Contracts\EmployeeLeaveAllocationRepositoryInterface;
use Illuminate\Http\Request;
use App\DataTables\Dashboard\Admin\EmployeeShowLeaveAllocationDataTable;
class EmployeeLeaveAllocationRepository extends BaseRepository implements EmployeeLeaveAllocationRepositoryInterface {
    protected $rules = [
        //'name_ar'   => 'nullable|string|max:255',
        //'name_en'   => 'nullable|string|max:255',
    ];

    public function __construct(EmployeeLeaveAllocation $model) {
        parent::__construct($model);
    }

    public function findWithRelations($id) {
        return Employee::with([
            'jobCategory:id,name',
            'section:id,name'
        ])->findOrFail($id);
    }

    public function getLeaveVariablesList() {
        return LeaveVariable::select('id', 'name_ar', 'code', 'symbol')->get();
    }

    protected function extraStoreFields(Request $request): array {
        return [
            'employee_id' => $request->employee_id,
            'leave_variable_id' => $request->leave_variable_id,
            'allocated_balance' => $request->allocated_balance,
            'is_year' => $request->has('is_year'),
            'is_break_year' => $request->has('is_break_year'),
            'year' => $request->year,
        ];
    }

    public function getShowDataTable($employeeId)
    {
        return new EmployeeShowLeaveAllocationDataTable($employeeId);
    }

    protected function extraUpdateFields(Request $request, $id): array
    {
        $record = $this->model->findOrFail($id);
        $rules = $this->rules;
        $request->validate($rules);

        return [
            'previous_years_balance' => $request->previous_years_balance,
            'allocated_balance' => $request->allocated_balance,
        ];
    }
}
