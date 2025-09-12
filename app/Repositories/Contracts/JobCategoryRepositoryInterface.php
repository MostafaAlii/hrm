<?php

namespace App\Repositories\Contracts;

use App\DataTables\Dashboard\Admin\JobCategoryDataTable;
use Illuminate\Http\Request;
use App\Models\JobCategory;

interface JobCategoryRepositoryInterface
{
    public function index(JobCategoryDataTable $jobCategoryDataTable);
    public function create();
    public function store(Request $request);
    public function edit($id);
    public function update(Request $request, $id);
    public function destroy(JobCategory $jobCategory);
}