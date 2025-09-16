<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Repositories\Eloquents\EmployeeRepository;
use App\DataTables\Dashboard\Admin\EmployeeDataTable;
use Illuminate\Http\Request;
use App\Models\Employee;

class EmployeeController extends Controller
{
    protected $repository;

    public function __construct(EmployeeRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index(EmployeeDataTable $dataTable)
    {
        return $this->repository->index(
            $dataTable,
            'dashboard.admin.employees.index',
            'الموظفين '
        );
    }

    public function create()
    {
        return $this->repository->create(
            'dashboard.admin.employees.btn.create',
            'إضافة موظف'
        );
    }

    public function store(Request $request)
    {
        return $this->repository->store($request);
    }

    public function edit($id)
    {
        return $this->repository->edit(
            $id,
            'dashboard.admin.employees.btn.edit',
            'تعديل  موظف'
        );
    }

    public function update(Request $request, $id)
    {
        return $this->repository->update($request, $id);
    }

    public function destroy(Employee $employee)
    {
        return $this->repository->destroy($employee);
    }
}