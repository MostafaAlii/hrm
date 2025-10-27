<?php

namespace App\Http\Controllers\Dashboard;

use App\DataTables\Dashboard\Admin\AllowanceVariableDataTable;
use App\Http\Controllers\Controller;
use App\Repositories\Contracts\AllowanceVariableRepositoryInterface;
use Illuminate\Http\Request;

class AllowanceVariableController extends Controller
{
    public function __construct(protected AllowanceVariableRepositoryInterface $repository) {}

    public function index(AllowanceVariableDataTable $dataTable)
    {
        return $this->repository->index($dataTable, 'dashboard.admin.salaries.allowance-variables.index', 'متغيرات العلاوات');
    }

    public function create()
    {
        return $this->repository->create('dashboard.admin.salaries.allowance-variables.create', 'إضافة متغير علاوة');
    }

    public function store(Request $request)
    {
        return $this->repository->store($request);
    }


    public function edit($id)
    {
        return $this->repository->edit($id, 'dashboard.admin.salaries.allowance-variables.edit', 'تعديل متغير العلاوة');
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
