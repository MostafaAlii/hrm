<?php
namespace App\Http\Controllers\Dashboard;
use App\DataTables\Dashboard\Admin\SalaryCardDataTable;
use App\Http\Controllers\Controller;
use App\Repositories\Contracts\SalaryCardRepositoryInterface;
use Illuminate\Http\Request;
class SalaryCardController extends Controller {
    public function __construct(protected SalaryCardRepositoryInterface $repository) {}

    public function index(SalaryCardDataTable $dataTable)
    {
        return $this->repository->index($dataTable, 'dashboard.admin.salaryCards.index', 'كروت المرتبات');
    }

    public function create()
    {
        return $this->repository->create('dashboard.admin.salaryCards.create', 'كروت المرتبات');
    }

    public function store(Request $request)
    {
        return $this->repository->store($request);
    }

    public function edit($id)
    {
        return $this->repository->edit($id, 'dashboard.admin.salaryCards.edit', 'كروت المرتبات');
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