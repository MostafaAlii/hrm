<?php

namespace App\Repositories\Contracts;

use App\DataTables\Dashboard\Admin\ReligionDataTable;
use Illuminate\Http\Request;
use App\Models\Religion;

interface ReligionRepositoryInterface
{
    public function index(ReligionDataTable $religionDataTable);
    public function create();
    public function store(Request $request);
    public function edit($id);
    public function update(Request $request, $id);
    public function destroy(Religion $religion);
}