<?php

namespace App\Repositories\Contracts;

use App\DataTables\Dashboard\Admin\TerminationTypeDataTable;
use Illuminate\Http\Request;
use App\Models\TerminationType;

interface TerminationTypeRepositoryInterface
{
    public function index(TerminationTypeDataTable $terminationTypeDataTable);
    public function create();
    public function store(Request $request);
    public function edit($id);
    public function update(Request $request, $id);
    public function destroy(TerminationType $terminationType);
}