<?php

namespace App\Http\Controllers\Dashboard;

use App\DataTables\Dashboard\Admin\ContractTypeDataTable;
use App\Http\Controllers\Controller;
use App\Repositories\Contracts\ContractTypeRepositoryInterface;
use Illuminate\Http\Request;

class ContractTypeController extends Controller
{
    public function __construct(protected ContractTypeRepositoryInterface $repository) {}

    public function index(ContractTypeDataTable $dataTable)
    {
        return $this->repository->index($dataTable, 'dashboard.admin.contract_types.index', trans('dashboard/contract_type.title'));
    }

    public function create()
    {
        return $this->repository->create('dashboard.admin.contract_types.create', trans('dashboard/contract_type.create'));
    }

    public function store(Request $request)
    {
        return $this->repository->store($request);
    }

    public function edit($id)
    {
        return $this->repository->edit($id, 'dashboard.admin.contract_types.edit', trans('dashboard/contract_type.edit'));
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
