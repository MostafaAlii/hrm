<?php

namespace App\Http\Controllers\Dashboard;
use App\Http\Controllers\Controller;
use App\Repositories\Contracts\RelativeDegreeRepositoryInterface;
use Illuminate\Http\Request;
use App\DataTables\Dashboard\Admin\RelativeDegreeDataTable;
class RelativeDegreeController extends Controller {
    protected $repository;
    public function __construct(RelativeDegreeRepositoryInterface $repository) {
        $this->repository = $repository;
    }

    public function index(RelativeDegreeDataTable $dataTable)
    {
        return $this->repository->index($dataTable, 'dashboard.admin.relative_degrees.index', 'درجات القرابة');
    }

    public function create()
    {
        return $this->repository->create('dashboard.admin.relative_degrees.create', 'إضافة درجة قرابة');
    }

    public function store(Request $request)
    {
        return $this->repository->store($request);
    }

    public function edit($id)
    {
        return $this->repository->edit($id, 'dashboard.admin.relative_degrees.edit', 'تعديل درجة القرابة');
    }

    public function update(Request $request, $id)
    {
        return $this->repository->update($request, $id);
    }

    public function destroy($id)
    {
        $model = app(\App\Models\RelativeDegree::class)->findOrFail($id);
        return $this->repository->destroy($model);
    }
}
