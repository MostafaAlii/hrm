<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\DataTables\Dashboard\Admin\DepartmentDataTable;
use App\Models\Department;
use App\Repositories\Contracts\DepartmentRepositoryInterface;

class DepartmentController extends Controller
{
    public function __construct(protected DepartmentDataTable $departmentDataTable, protected DepartmentRepositoryInterface $departmentInterface) {
        $this->departmentInterface = $departmentInterface;
        $this->departmentDataTable = $departmentDataTable;
    }

    public function index(DepartmentDataTable $departmentDataTable) {
        return $this->departmentInterface->index($this->departmentDataTable);
    }

    public function create() {
        return $this->departmentInterface->create();
    }

    public function store(Request $request) {
        return $this->departmentInterface->store($request);
    }

    public function edit($id) {
        return $this->departmentInterface->edit($id);
    }

    public function update(Request $request, $id) {
        return $this->departmentInterface->update($request, $id);
    }

    public function destroy(Department $department) {
        return $this->departmentInterface->destroy($department);
    }
}