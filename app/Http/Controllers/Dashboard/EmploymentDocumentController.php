<?php

namespace App\Http\Controllers\Dashboard;

use App\DataTables\Dashboard\Admin\EmploymentDocumentDataTable;
use App\Http\Controllers\Controller;
use App\Repositories\Contracts\EmploymentDocumentRepositoryInterface;
use Illuminate\Http\Request;

class EmploymentDocumentController extends Controller
{
    public function __construct(protected EmploymentDocumentRepositoryInterface $repository) {}

    public function index(EmploymentDocumentDataTable $dataTable)
    {
        return $this->repository->index($dataTable, 'dashboard.admin.employmentDocuments.index', 'مصوغات التعيين');
    }

    public function create()
    {
        return $this->repository->create('dashboard.admin.employmentDocuments.create', 'مصوغات التعيين');
    }

    public function store(Request $request)
    {
        return $this->repository->store($request);
    }

    public function edit($id)
    {
        return $this->repository->edit($id, 'dashboard.admin.employmentDocuments.edit', 'مصوغات التعيين');
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