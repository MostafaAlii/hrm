<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\DataTables\Dashboard\Admin\ShiftTypeDataTable;
use App\Models\ShiftType;
use App\Repositories\Contracts\ShiftTypeRepositoryInterface;

class ShiftTypeController extends Controller
{
    public function __construct(protected ShiftTypeDataTable $shiftTypeDataTable, protected ShiftTypeRepositoryInterface $shiftTypeInterface)
    {
        $this->shiftTypeInterface = $shiftTypeInterface;
        $this->shiftTypeDataTable = $shiftTypeDataTable;
    }

    public function index(ShiftTypeDataTable $shiftTypeDataTable)
    {
        return $this->shiftTypeInterface->index($this->shiftTypeDataTable);
    }

    public function create()
    {
        return $this->shiftTypeInterface->create();
    }

    public function store(Request $request)
    {
        return $this->shiftTypeInterface->store($request);
    }

    public function edit($id)
    {
        return $this->shiftTypeInterface->edit($id);
    }

    public function update(Request $request, $id)
    {
        return $this->shiftTypeInterface->update($request, $id);
    }

    public function destroy(ShiftType $shiftType)
    {
        return $this->shiftTypeInterface->destroy($shiftType);
    }
}