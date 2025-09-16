<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Repositories\Eloquents\BankVariableRepository;
use App\DataTables\Dashboard\Admin\BankVariableDataTable;
use Illuminate\Http\Request;
use App\Models\BankVariable;

class BankVariableController extends Controller
{
    protected $repository;

    public function __construct(BankVariableRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index(BankVariableDataTable $dataTable)
    {
        return $this->repository->index(
            $dataTable,
            'dashboard.admin.bankVariables.index',
            'متغيرات المزايا'
        );
    }

    public function create()
    {
        return $this->repository->create(
            'dashboard.admin.benefitVariables.btn.create',
            'إضافة متغير ميزة'
        );
    }

    public function store(Request $request)
    {
        return $this->repository->store($request);
    }

    public function edit($id)
    {
        return $this->repository->edit(
            $id,
            'dashboard.admin.benefitVariables.btn.edit',
            'تعديل متغير ميزة'
        );
    }

    public function update(Request $request, $id)
    {
        return $this->repository->update($request, $id);
    }

    public function destroy(BankVariable $bankVariable)
    {
        return $this->repository->destroy($bankVariable);
    }
}
