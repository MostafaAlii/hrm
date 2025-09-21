<?php

namespace App\Http\Controllers\Dashboard;

use App\DataTables\Dashboard\Admin\InsuranceOfficeDataTable;
use App\Http\Controllers\Controller;
use App\Repositories\Contracts\InsuranceOfficeRepositoryInterface;
use Illuminate\Http\Request;

class InsuranceOfficeController extends Controller {
    public function __construct(protected InsuranceOfficeRepositoryInterface $repository) {}

    public function index(InsuranceOfficeDataTable $dataTable)
    {
        return $this->repository->index($dataTable, 'dashboard.admin.insurance_offices.index', trans('dashboard/insurance_office.title'));
    }

    public function create()
    {
        return $this->repository->create('dashboard.admin.insurance_offices.create', trans('dashboard/insurance_office.create'));
    }

    public function store(Request $request)
    {
        return $this->repository->store($request);
    }

    public function edit($id)
    {
        return $this->repository->edit($id, 'dashboard.admin.insurance_offices.edit', trans('dashboard/insurance_office.edit'));
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
