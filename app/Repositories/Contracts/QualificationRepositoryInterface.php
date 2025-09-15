<?php

namespace App\Repositories\Contracts;

use App\DataTables\Dashboard\Admin\QualificationDataTable;
use Illuminate\Http\Request;
use App\Models\Qualification;

interface QualificationRepositoryInterface
{
    public function index(QualificationDataTable $qualificationDataTable);
    public function create();
    public function store(Request $request);
    public function edit($id);
    public function update(Request $request, $id);
    public function destroy(Qualification $qualification);
}