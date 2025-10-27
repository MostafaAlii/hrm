<?php

namespace App\Http\Controllers\Dashboard;

use App\DataTables\Dashboard\Admin\DeductionVariableDataTable;
use App\Http\Controllers\Controller;
use App\Repositories\Contracts\DeductionVariableRepositoryInterface;
use Illuminate\Http\Request;

class DeductionVariableController extends Controller
{
    public function __construct(protected DeductionVariableRepositoryInterface $repository) {}

    public function index(DeductionVariableDataTable $dataTable)
    {
        return $this->repository->index($dataTable, 'dashboard.admin.salaries.deduction-variables.index', 'متغيرات الاستقطاعات');
    }

    public function create()
    {
        return $this->repository->create('dashboard.admin.salaries.deduction-variables.create', 'إضافة متغير استقطاع');
    }

    public function store(Request $request)
    {
        return $this->repository->store($request);
    }


    public function edit($id)
    {
        return $this->repository->edit($id, 'dashboard.admin.salaries.deduction-variables.edit', 'تعديل متغير الاستقطاع');
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
