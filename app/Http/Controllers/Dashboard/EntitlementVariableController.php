<?php

namespace App\Http\Controllers\Dashboard;

use App\DataTables\Dashboard\Admin\EntitlementVariableDataTable;
use App\Http\Controllers\Controller;
use App\Repositories\Contracts\EntitlementVariableRepositoryInterface;
use Illuminate\Http\Request;

class EntitlementVariableController extends Controller
{
    public function __construct(protected EntitlementVariableRepositoryInterface $repository) {}

    public function index(EntitlementVariableDataTable $dataTable)
    {
        return $this->repository->index($dataTable, 'dashboard.admin.salaries.entitlement-variables.index', 'متغيرات الاستحقاقات');
    }

    public function create()
    {
        return $this->repository->create('dashboard.admin.salaries.entitlement-variables.create', 'إضافة متغير استحقاق');
    }

    public function store(Request $request)
    {
        return $this->repository->store($request);
    }


    public function edit($id)
    {
        return $this->repository->edit($id, 'dashboard.admin.salaries.entitlement-variables.edit', 'تعديل متغير الاستحقاق');
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
