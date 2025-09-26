<?php
namespace App\Http\Controllers\Dashboard;
use App\DataTables\Dashboard\Admin\InsuranceTypeDataTable;
use App\Http\Controllers\Controller;
use App\Repositories\Contracts\InsuranceTypeRepositoryInterface;
use Illuminate\Http\Request;

class InsuranceTypeController extends Controller {
    public function __construct(protected InsuranceTypeRepositoryInterface $repository) {}

    public function index(InsuranceTypeDataTable $dataTable)
    {
        return $this->repository->index($dataTable, 'dashboard.admin.insurance_types.index', trans('dashboard/insurance_type.title'));
    }

    public function create()
    {
        return $this->repository->create('dashboard.admin.insurance_types.create', trans('dashboard/insurance_type.create'));
    }

    public function store(Request $request)
    {
        return $this->repository->store($request);
    }

    public function edit($id)
    {
        return $this->repository->edit($id, 'dashboard.admin.insurance_types.edit', trans('dashboard/insurance_type.edit'));
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