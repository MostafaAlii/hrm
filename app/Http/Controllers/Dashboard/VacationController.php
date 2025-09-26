<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\DataTables\Dashboard\Admin\VacationDataTable;
use App\Models\Vacation;
use App\Repositories\Contracts\VacationRepositoryInterface;

class VacationController extends Controller
{
    public function __construct(protected VacationDataTable $vacationDataTable, protected VacationRepositoryInterface $vacationInterface)
    {
        $this->vacationInterface = $vacationInterface;
        $this->vacationDataTable = $vacationDataTable;
    }

    public function index(VacationDataTable $vacationDataTable)
    {
        return $this->vacationInterface->index($this->vacationDataTable);
    }

    public function create()
    {
        return $this->vacationInterface->create();
    }

    public function store(Request $request)
    {
        return $this->vacationInterface->store($request);
    }

    public function edit($id)
    {
        return $this->vacationInterface->edit($id);
    }

    public function update(Request $request, $id)
    {
        return $this->vacationInterface->update($request, $id);
    }

    public function destroy(Vacation $vacation)
    {
        return $this->vacationInterface->destroy($vacation);
    }
}