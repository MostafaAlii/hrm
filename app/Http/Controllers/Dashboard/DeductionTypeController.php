<?php

namespace App\Http\Controllers\Dashboard;

use App\DataTables\Dashboard\Admin\DeductionTypeDataTable;
use App\Http\Controllers\Controller;
use App\Repositories\Contracts\DeductionTypeRepositoryInterface;
use Illuminate\Http\Request;

class DeductionTypeController extends Controller
{
    public function __construct(protected DeductionTypeRepositoryInterface $repository) {}

    public function index(DeductionTypeDataTable $dataTable)
    {
        return $this->repository->index($dataTable, 'dashboard.admin.salaries.deduction-types.index', 'أنواع الاستقطاعات');
    }

    public function create()
    {
        return $this->repository->create('dashboard.admin.salaries.deduction-types.create', 'إضافة نوع استقطاع');
    }

    public function store(Request $request)
    {
        return $this->repository->store($request);
    }

    public function edit($id)
    {
        return $this->repository->edit($id, 'dashboard.admin.salaries.deduction-types.edit', 'تعديل نوع الاستقطاع');
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
