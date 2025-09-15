<?php

namespace  App\Repositories\Eloquents;

use App\Models\{JobCategory,Department};
use App\Repositories\Contracts\JobCategoryRepositoryInterface;
use Illuminate\Http\Request;
use App\DataTables\Dashboard\Admin\JobCategoryDataTable;

class JobCategoryRepository implements JobCategoryRepositoryInterface
{
    public function index(JobCategoryDataTable $branchDataTable)
    {
        $departments = Department::active()->get();
        return $branchDataTable->render('dashboard.admin.jobCategories.index', ['departments' => $departments, 'title' => 'الوظائف']);
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
            'department_id' => 'required|exists:departments,id',
            'section_id'    => 'required|exists:sections,id',
        ]);
        JobCategory::create([
            'name' => $request->name,
            'department_id' => $request->department_id,
            'section_id'    => $request->section_id,
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
            'department_id' => 'required|exists:departments,id',
            'section_id' => 'required|exists:sections,id',
        ]);

        $jobCategory = JobCategory::findOrFail($id);
        $jobCategory->update([
            'name' => $request->name,
            'department_id' => $request->department_id,
            'section_id' => $request->section_id,
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