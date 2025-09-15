<?php

namespace  App\Repositories\Eloquents;

use App\Models\Department;
use App\Repositories\Contracts\DepartmentRepositoryInterface;
use Illuminate\Http\Request;
use App\DataTables\Dashboard\Admin\DepartmentDataTable;

class DepartmentRepository implements DepartmentRepositoryInterface
{
    public function index(DepartmentDataTable $departmentDataTable)
    {
        return $departmentDataTable->render('dashboard.admin.departments.index', ['title' => 'الادارات']);
    }

    public function create()
    {
        return view('dashboard.admin.departments.btn.create', ['title' => 'إضافة اداره']);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'note' => 'nullable|string',
            'phone' => 'nullable|string',
            'is_active' => 'nullable|boolean',
        ]);
        Department::create([
            'name' => $request->name,
            'note' => $request->note,
            'phone' => $request->phone,
            'is_active' => $request->has('is_active'),
        ]);
        return redirect()->route('admin.departments.index')->with('success', 'تم حفظ الاداره بنجاح!');
    }

    public function edit($id)
    {
        $department = Department::findOrFail($id);
        return view('dashboard.admin.departments.btn.edit', ['department' => $department, 'title' => 'تعديل اداره']);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'note' => 'nullable|string',
            'phone' => 'nullable|string',
            'is_active' => 'nullable|boolean',
        ]);

        $department = Department::findOrFail($id);
        $department->update([
            'name' => $request->name,
            'note' => $request->note,
            'phone' => $request->phone,
            'is_active' => $request->has('is_active') ? 1 : 0,
        ]);
        return redirect()->route('admin.departments.index')->with('success', 'تم تحديث الاداره بنجاح!');
    }

    public function destroy(Department $department)
    {
        $department->delete();
        return redirect()->route('admin.departments.index')->with('success', 'تم الحذف بنجاح!');
    }
}