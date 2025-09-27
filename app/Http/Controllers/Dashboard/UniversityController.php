<?php

namespace App\Http\Controllers\Dashboard;

use App\DataTables\Dashboard\Admin\UniversityDataTable;
use App\Http\Controllers\Controller;
use App\Repositories\Contracts\UniversityRepositoryInterface;
use Illuminate\Http\Request;

class UniversityController extends Controller
{
    public function __construct(protected UniversityRepositoryInterface $repository) {}

    public function index(UniversityDataTable $dataTable)
    {
        return $this->repository->index($dataTable, 'dashboard.admin.universities.index', ' الكليات و المدارس');
    }

    public function create()
    {
        return $this->repository->create('dashboard.admin.universities.create', ' الكليات و المدارس');
    }

    public function store(Request $request)
    {
        return $this->repository->store($request);
    }

    public function edit($id)
    {
        return $this->repository->edit($id, 'dashboard.admin.universities.edit', ' الكليات و المدارس');
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
