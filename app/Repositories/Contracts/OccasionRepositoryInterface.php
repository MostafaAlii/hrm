<?php

namespace App\Repositories\Contracts;

use App\DataTables\Dashboard\Admin\OccasionDataTable;
use Illuminate\Http\Request;
use App\Models\Occasion;

interface OccasionRepositoryInterface
{
    public function index(OccasionDataTable $occasionDataTable);
    public function create();
    public function store(Request $request);
    public function edit($id);
    public function update(Request $request, $id);
    public function destroy(Occasion $occasion);
}