<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\DataTables\Dashboard\Admin\QualificationDataTable;
use App\Models\Qualification;
use App\Repositories\Contracts\QualificationRepositoryInterface;

class QualificationController extends Controller
{
    public function __construct(protected QualificationDataTable $qualificationDataTable, protected QualificationRepositoryInterface $qualificationInterface)
    {
        $this->qualificationInterface = $qualificationInterface;
        $this->qualificationDataTable = $qualificationDataTable;
    }

    public function index(QualificationDataTable $qualificationDataTable)
    {
        return $this->qualificationInterface->index($this->qualificationDataTable);
    }

    public function create()
    {
        return $this->qualificationInterface->create();
    }

    public function store(Request $request)
    {
        return $this->qualificationInterface->store($request);
    }

    public function edit($id)
    {
        return $this->qualificationInterface->edit($id);
    }

    public function update(Request $request, $id)
    {
        return $this->qualificationInterface->update($request, $id);
    }

    public function destroy(Qualification $qualification)
    {
        return $this->qualificationInterface->destroy($qualification);
    }
}