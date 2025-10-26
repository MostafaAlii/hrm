<?php

namespace App\Http\Controllers\Dashboard;

use App\DataTables\Dashboard\Admin\RevenueTypeDataTable;
use App\Http\Controllers\Controller;
use App\Repositories\Contracts\RevenueTypeRepositoryInterface;
use Illuminate\Http\Request;

class RevenueTypeController extends Controller
{
    public function __construct(protected RevenueTypeRepositoryInterface $repository) {}

    public function index(RevenueTypeDataTable $dataTable)
    {
        return $this->repository->index($dataTable, 'dashboard.admin.salaries.revenue-types.index', 'أنواع الإيرادات');
    }

    public function create()
    {
        return $this->repository->create('dashboard.admin.salaries.revenue-types.create', 'إضافة نوع إيراد');
    }

    public function store(Request $request)
    {
        return $this->repository->store($request);
    }

    public function edit($id)
    {
        return $this->repository->edit($id, 'dashboard.admin.salaries.revenue-types.edit', 'تعديل نوع الإيراد');
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
