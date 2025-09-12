<?php

namespace App\Repositories\Contracts;

use App\DataTables\Dashboard\Admin\DepartmentDataTable;
use Illuminate\Http\Request;
use App\Models\Department;

interface DepartmentRepositoryInterface
{
    public function index(DepartmentDataTable $departmentDataTable);
    public function create();
    public function store(Request $request);
    public function edit($id);
    public function update(Request $request, $id);
    public function destroy(Department $department);
}