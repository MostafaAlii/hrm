<?php

namespace App\Http\Controllers\Dashboard;

use App\DataTables\Dashboard\Admin\TaxTransactionTypeDataTable;
use App\Http\Controllers\Controller;
use App\Repositories\Contracts\TaxTransactionTypeRepositoryInterface;
use Illuminate\Http\Request;

class TaxTransactionTypeController extends Controller {
    public function __construct(protected TaxTransactionTypeRepositoryInterface $repository) {}

    public function index(TaxTransactionTypeDataTable $dataTable)
    {
        return $this->repository->index($dataTable, 'dashboard.admin.salaries.tax-transaction-types.index', 'أنواع المعاملات الضريبية');
    }

    public function create()
    {
        return $this->repository->create('dashboard.admin.salaries.tax-transaction-types.btn.create', 'إضافة نوع معاملة ضريبية');
    }

    public function store(Request $request)
    {
        return $this->repository->store($request);
    }

    public function edit($id)
    {
        return $this->repository->edit($id, 'dashboard.admin.salaries.tax-transaction-types.edit', 'تعديل نوع المعاملة الضريبية');
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
