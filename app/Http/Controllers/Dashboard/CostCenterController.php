<?php

namespace App\Http\Controllers\Dashboard;

use App\DataTables\Dashboard\Admin\CostCenterDataTable;
use App\Http\Controllers\Controller;
use App\Repositories\Contracts\CostCenterRepositoryInterface;
use Illuminate\Http\Request;

class CostCenterController extends Controller
{
    public function __construct(protected CostCenterRepositoryInterface $repository) {}

    public function index(CostCenterDataTable $dataTable)
    {
        return $this->repository->index($dataTable, 'dashboard.admin.costCenters.index', 'مراكز التكلفه');
    }

    public function create()
    {
        return $this->repository->create('dashboard.admin.costCenters.create', 'مراكز التكلفه');
    }

    public function store(Request $request)
    {
        return $this->repository->store($request);
    }

    public function edit($id)
    {
        return $this->repository->edit($id, 'dashboard.admin.costCenters.edit', 'مراكز التكلفه');
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