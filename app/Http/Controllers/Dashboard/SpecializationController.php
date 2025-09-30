<?php

namespace App\Http\Controllers\Dashboard;

use App\DataTables\Dashboard\Admin\SpecializationDataTable;
use App\Http\Controllers\Controller;
use App\Repositories\Contracts\SpecializationRepositoryInterface;
use Illuminate\Http\Request;

class SpecializationController extends Controller
{
    public function __construct(protected SpecializationRepositoryInterface $repository) {}

    public function index(SpecializationDataTable $dataTable)
    {
        return $this->repository->index($dataTable, 'dashboard.admin.specializations.index', '  التخصصات');
    }

    public function create()
    {
        return $this->repository->create('dashboard.admin.specializations.create', '  التخصصات');
    }

    public function store(Request $request)
    {
        return $this->repository->store($request);
    }

    public function edit($id)
    {
        return $this->repository->edit($id, 'dashboard.admin.specializations.edit', '  التخصصات');
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
