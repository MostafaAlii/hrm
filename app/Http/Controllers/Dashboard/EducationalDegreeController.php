<?php

namespace App\Http\Controllers\Dashboard;

use App\DataTables\Dashboard\Admin\EducationalDegreeDataTable;
use App\Http\Controllers\Controller;
use App\Repositories\Contracts\EducationalDegreeRepositoryInterface;
use Illuminate\Http\Request;

class EducationalDegreeController extends Controller
{
    public function __construct(protected EducationalDegreeRepositoryInterface $repository) {}

    public function index(EducationalDegreeDataTable $dataTable)
    {
        return $this->repository->index($dataTable, 'dashboard.admin.educational-degrees.index', trans('dashboard/educational_degree.title'));
    }

    public function create()
    {
        return $this->repository->create('dashboard.admin.educational-degrees.create', trans('dashboard/educational_degree.create'));
    }

    public function store(Request $request)
    {
        //dd($request->all());
        return $this->repository->store($request);
    }

    public function edit($id)
    {
        return $this->repository->edit($id, 'dashboard.admin.educational-degrees.edit', trans('dashboard/educational_degree.edit'));
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