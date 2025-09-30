<?php

namespace App\Http\Controllers\Dashboard;

use App\DataTables\Dashboard\Admin\GradeDataTable;
use App\Http\Controllers\Controller;
use App\Repositories\Contracts\GradeRepositoryInterface;
use Illuminate\Http\Request;

class GradeController extends Controller
{
    public function __construct(protected GradeRepositoryInterface $repository) {}

    public function index(GradeDataTable $dataTable)
    {
        return $this->repository->index($dataTable, 'dashboard.admin.grades.index', ' التقديرات');
    }

    public function create()
    {
        return $this->repository->create('dashboard.admin.grades.create', 'انواع التقديرات');
    }

    public function store(Request $request)
    {
        return $this->repository->store($request);
    }

    public function edit($id)
    {
        return $this->repository->edit($id, 'dashboard.admin.educational-degrees.edit', 'انواع التقديرات');
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