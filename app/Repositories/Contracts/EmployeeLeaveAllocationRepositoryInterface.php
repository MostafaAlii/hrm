<?php

namespace App\Repositories\Contracts;

use Illuminate\Http\Request;

interface EmployeeLeaveAllocationRepositoryInterface extends BaseRepositoryInterface
{
    public function index($dataTable, $view, $title);
    public function create($view, $title);
    public function find($id);
    public function findWithRelations($id);
    public function getLeaveVariablesList();
    public function store(Request $request);
    public function edit($id, $view, $title);
    public function update(Request $request, $id);
    public function destroy($model);
    public function getShowDataTable($employeeId);
}
