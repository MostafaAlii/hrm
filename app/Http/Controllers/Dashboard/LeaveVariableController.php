<?php

namespace App\Http\Controllers\Dashboard;
use App\DataTables\Dashboard\Admin\LeaveVariableDataTable;
use App\Http\Controllers\Controller;
use App\Repositories\Contracts\LeaveVariableRepositoryInterface;
use Illuminate\Http\Request;
class LeaveVariableController extends Controller {
    public function __construct(protected LeaveVariableRepositoryInterface $repository) {}

    public function index(LeaveVariableDataTable $dataTable)
    {
        return $this->repository->index($dataTable, 'dashboard.admin.LeaveVariable.index', 'متغيرات الاجازات');
    }

    public function store(Request $request)
    {
        return $this->repository->store($request);
    }

    public function update(Request $request, $id) {
        return $this->repository->update($request, $id);
    }

    public function destroy($id) {
        $record = $this->repository->find($id);
        return $this->repository->destroy($record);
    }
}
