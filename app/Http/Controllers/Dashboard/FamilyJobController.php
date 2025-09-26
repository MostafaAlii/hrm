<?php

namespace App\Http\Controllers\Dashboard;

use App\DataTables\Dashboard\Admin\FamilyJobDataTable;
use App\Http\Controllers\Controller;
use App\Repositories\Contracts\FamilyJobRepositoryInterface;
use Illuminate\Http\Request;

class FamilyJobController extends Controller
{
    public function __construct(protected FamilyJobRepositoryInterface $repository) {}

    public function index(FamilyJobDataTable $dataTable)
    {
        return $this->repository->index($dataTable, 'dashboard.admin.family_jobs.index', trans('dashboard/family_job.title'));
    }

    public function create()
    {
        return $this->repository->create('dashboard.admin.family_jobs.create', trans('dashboard/family_job.create'));
    }

    public function store(Request $request)
    {
        return $this->repository->store($request);
    }

    public function edit($id)
    {
        return $this->repository->edit($id, 'dashboard.admin.family_jobs.edit', trans('dashboard/family_job.edit'));
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
