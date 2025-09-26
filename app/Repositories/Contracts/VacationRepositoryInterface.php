<?php

namespace App\Repositories\Contracts;

use App\DataTables\Dashboard\Admin\VacationDataTable;
use Illuminate\Http\Request;
use App\Models\Vacation;

interface VacationRepositoryInterface
{
    public function index(VacationDataTable $vacationDataTable);
    public function create();
    public function store(Request $request);
    public function edit($id);
    public function update(Request $request, $id);
    public function destroy(Vacation $vacation);
}