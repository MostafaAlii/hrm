<?php

namespace App\Http\Controllers\Dashboard;

use App\DataTables\Dashboard\Admin\LicenseVariableDataTable;
use App\Http\Controllers\Controller;
use App\Repositories\Contracts\LicenseVariableRepositoryInterface;
use Illuminate\Http\Request;

class LicenseVariableController extends Controller
{
    public function __construct(protected LicenseVariableRepositoryInterface $repository) {}

    public function index(LicenseVariableDataTable $dataTable)
    {
        return $this->repository->index($dataTable, 'dashboard.admin.licenseVariable.index', 'متغيرات الرخص');
    }

    public function create()
    {
        return $this->repository->create('dashboard.admin.licenseVariable.create', 'متغيرات الرخص');
    }

    public function store(Request $request)
    {
        return $this->repository->store($request);
    }

    public function edit($id)
    {
        return $this->repository->edit($id, 'dashboard.admin.licenseVariable.edit', 'متغيرات الرخص');
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
