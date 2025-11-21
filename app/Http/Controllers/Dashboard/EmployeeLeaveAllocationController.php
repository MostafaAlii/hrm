<?php

namespace App\Http\Controllers\Dashboard;

use App\DataTables\Dashboard\Admin\{EmployeeLeaveAllocationDataTable, EmployeeShowLeaveAllocationDataTable};
use App\Http\Controllers\Controller;
use App\Repositories\Contracts\EmployeeLeaveAllocationRepositoryInterface;
use Illuminate\Http\Request;

class EmployeeLeaveAllocationController extends Controller {
    public function __construct(protected EmployeeLeaveAllocationRepositoryInterface $repository) {}

    public function index(EmployeeLeaveAllocationDataTable $dataTable) {
        return $this->repository->index($dataTable, 'dashboard.admin.employeeLeaveAllocations.index', 'تخصيص اجازات الموظف');
    }

    public function show($id) {
        $emp_record = $this->repository->findWithRelations($id);
        $leaveVariables = $this->repository->getLeaveVariablesList();
        $dataTable = new EmployeeShowLeaveAllocationDataTable($id);
        /*return view('dashboard.admin.employeeLeaveAllocations.show', [
            'title'      => 'تخصيص اجازات الموظف',
            'emp_record' => $emp_record,
            'leaveVariables' => $leaveVariables,
            'dataTable'  => $this->repository->getShowDataTable($id),
        ]);*/
        return $dataTable->render('dashboard.admin.employeeLeaveAllocations.show', [
            'title'      => 'تخصيص اجازات الموظف',
            'emp_record' => $emp_record,
            'leaveVariables' => $leaveVariables,
        ]);
    }

    public function store(Request $request) {
        return $this->repository->store($request);
    }

    public function update(Request $request, $id)
    {
        return $this->repository->update($request, $id);
    }

    public function destroy($id)
    {
        $record = $this->repository->find($id);
        return $this->repository->destroy($record);
    }
}
