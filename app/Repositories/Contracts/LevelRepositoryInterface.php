<?php

namespace App\Repositories\Contracts;

use App\DataTables\Dashboard\Admin\LevelDataTable;
use Illuminate\Http\Request;
use App\Models\Level;

interface LevelRepositoryInterface {
    public function index(LevelDataTable $levelDataTable);
    public function create();
    public function store(Request $request);
    public function edit($id);
    public function update(Request $request, $id);
    public function destroy(Level $level);
}