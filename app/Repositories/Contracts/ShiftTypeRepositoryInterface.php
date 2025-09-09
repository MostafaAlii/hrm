<?php

namespace App\Repositories\Contracts;

use App\DataTables\Dashboard\Admin\ShiftTypeDataTable;
use Illuminate\Http\Request;
use App\Models\ShiftType;

interface ShiftTypeRepositoryInterface
{
    public function index(ShiftTypeDataTable $shiftTypeDataTable);
    public function create();
    public function store(Request $request);
    public function edit($id);
    public function update(Request $request, $id);
    public function destroy(ShiftType $shiftType);
}