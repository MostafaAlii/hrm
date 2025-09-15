<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\DataTables\Dashboard\Admin\JobCategoryDataTable;
use App\Models\JobCategory;
use App\Repositories\Contracts\JobCategoryRepositoryInterface;

class JobCategoryController extends Controller
{
    public function __construct(protected JobCategoryDataTable $jobCategoryDataTable, protected JobCategoryRepositoryInterface $jobCategoryInterface)
    {
        $this->jobCategoryInterface = $jobCategoryInterface;
        $this->jobCategoryDataTable = $jobCategoryDataTable;
    }

    public function index(JobCategoryDataTable $jobCategoryDataTable)
    {
        return $this->jobCategoryInterface->index($this->jobCategoryDataTable);
    }

    public function create()
    {
        return $this->jobCategoryInterface->create();
    }

    public function store(Request $request)
    {
        return $this->jobCategoryInterface->store($request);
    }

    public function edit($id)
    {
        return $this->jobCategoryInterface->edit($id);
    }

    public function update(Request $request, $id)
    {
        return $this->jobCategoryInterface->update($request, $id);
    }

    public function destroy(JobCategory $jobCategory)
    {
        return $this->jobCategoryInterface->destroy($jobCategory);
    }
}