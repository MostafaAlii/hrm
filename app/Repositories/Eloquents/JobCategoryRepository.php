<?php

namespace  App\Repositories\Eloquents;

use App\Models\JobCategory;
use App\Repositories\Contracts\JobCategoryRepositoryInterface;
use Illuminate\Http\Request;
use App\DataTables\Dashboard\Admin\JobCategoryDataTable;

class JobCategoryRepository implements JobCategoryRepositoryInterface
{
    public function index(JobCategoryDataTable $branchDataTable)
    {
        return $branchDataTable->render('dashboard.admin.jobCategories.index', ['title' => 'الوظائف']);
    }

    public function create()
    {
        return view('dashboard.admin.jobCategories.btn.create', ['title' => 'إضافة وظيفه']);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'is_active' => 'nullable|boolean',
        ]);
        JobCategory::create([
            'name' => $request->name,
            'is_active' => $request->has('is_active'),
        ]);
        return redirect()->route('admin.jobCategories.index')->with('success', 'تم حفظ الوظيفه بنجاح!');
    }

    public function edit($id)
    {
        $jobCategory = JobCategory::findOrFail($id);
        return view('dashboard.admin.jobCategories.btn.edit', ['jobCategory' => $jobCategory, 'title' => 'تعديل وظيفه']);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'is_active' => 'nullable|boolean',
        ]);

        $jobCategory = JobCategory::findOrFail($id);
        $jobCategory->update([
            'name' => $request->name,
            'is_active' => $request->has('is_active') ? 1 : 0,
        ]);
        return redirect()->route('admin.jobCategories.index')->with('success', 'تم تحديث الاداره بنجاح!');
    }

    public function destroy(JobCategory $jobCategory)
    {
        $jobCategory->delete();
        return redirect()->route('admin.jobCategories.index')->with('success', 'تم الحذف بنجاح!');
    }
}