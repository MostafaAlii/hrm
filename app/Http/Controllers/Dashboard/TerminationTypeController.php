<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\DataTables\Dashboard\Admin\TerminationTypeDataTable;
use App\Models\TerminationType;
use App\Repositories\Contracts\TerminationTypeRepositoryInterface;

class TerminationTypeController extends Controller
{
    public function __construct(protected TerminationTypeDataTable $terminationTypeDataTable, protected TerminationTypeRepositoryInterface $terminationTypeInterface)
    {
        $this->terminationTypeInterface = $terminationTypeInterface;
        $this->terminationTypeDataTable = $terminationTypeDataTable;
    }

    public function index(TerminationTypeDataTable $terminationTypeDataTable)
    {
        return $this->terminationTypeInterface->index($this->terminationTypeDataTable);
    }

    public function create()
    {
        return $this->terminationTypeInterface->create();
    }

    public function store(Request $request)
    {
        return $this->terminationTypeInterface->store($request);
    }

    public function edit($id)
    {
        return $this->terminationTypeInterface->edit($id);
    }

    public function update(Request $request, $id)
    {
        return $this->terminationTypeInterface->update($request, $id);
    }

    public function destroy(TerminationType $terminationType)
    {
        return $this->terminationTypeInterface->destroy($terminationType);
    }
}