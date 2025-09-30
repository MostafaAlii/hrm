<?php

namespace App\Http\Controllers\Dashboard;

use App\DataTables\Dashboard\Admin\PenaltyTypeDataTable;
use App\Http\Controllers\Controller;
use App\Repositories\Contracts\PenaltyTypeRepositoryInterface;
use Illuminate\Http\Request;

class PenaltyTypeController extends Controller
{
    public function __construct(protected PenaltyTypeRepositoryInterface $repository) {}

    public function index(PenaltyTypeDataTable $dataTable)
    {
        return $this->repository->index($dataTable, 'dashboard.admin.penalty-types.index', 'انواع الجزاءات');
    }

    public function create()
    {
        return $this->repository->create('dashboard.admin.penalty-types.create', 'انواع الجزاءات');
    }

    public function store(Request $request)
    {
        //dd($request->all());
        return $this->repository->store($request);
    }

    public function edit($id)
    {
        return $this->repository->edit($id, 'dashboard.admin.penalty-types.edit', 'انواع الجزاءات');
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