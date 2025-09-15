<?php

namespace App\Repositories\Contracts;

use App\DataTables\Dashboard\Admin\NationalityDataTable;
use Illuminate\Http\Request;
use App\Models\Nationality;

interface NationalityRepositoryInterface
{
    public function index(NationalityDataTable $nationalityDataTable);
    public function create();
    public function store(Request $request);
    public function edit($id);
    public function update(Request $request, $id);
    public function destroy(Nationality $nationality);
}