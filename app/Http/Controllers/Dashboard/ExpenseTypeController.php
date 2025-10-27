<?php

namespace App\Http\Controllers\Dashboard;

use App\DataTables\Dashboard\Admin\ExpenseTypeDataTable;
use App\Http\Controllers\Controller;
use App\Repositories\Contracts\ExpenseTypeRepositoryInterface;
use Illuminate\Http\Request;

class ExpenseTypeController extends Controller
{
    public function __construct(protected ExpenseTypeRepositoryInterface $repository) {}

    public function index(ExpenseTypeDataTable $dataTable)
    {
        return $this->repository->index($dataTable, 'dashboard.admin.salaries.expense-types.index', 'أنواع الصرفيات');
    }

    public function create()
    {
        return $this->repository->create('dashboard.admin.salaries.expense-types.create', 'إضافة نوع صرفية');
    }

    public function store(Request $request)
    {
        return $this->repository->store($request);
    }

    public function edit($id)
    {
        return $this->repository->edit($id, 'dashboard.admin.salaries.expense-types.edit', 'تعديل نوع الصرفية');
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
