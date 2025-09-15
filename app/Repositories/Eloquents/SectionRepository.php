<?php

namespace  App\Repositories\Eloquents;

use App\Models\{Section, Department};
use App\Repositories\Contracts\SectionRepositoryInterface;
use Illuminate\Http\Request;
use App\DataTables\Dashboard\Admin\SectionDataTable;

class SectionRepository implements SectionRepositoryInterface
{
    public function index(SectionDataTable $sectionDataTable)
    {
        $departments = Department::active()->get();
        return $sectionDataTable->render('dashboard.admin.section.index', ['departments' => $departments,'title' => 'الاقسام']);
    }

    public function create()
    {
        return view('dashboard.admin.section.btn.create', ['title' => 'إضافة قسم']);
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'is_active' => 'nullable|boolean',

        ]);
        Section::create([
            'name' => $request->name,
            'department_id' => $request->department_id,
            'is_active' => $request->has('is_active'),
        ]);
        return redirect()->route('admin.section.index')->with('success', 'تم حفظ القسم بنجاح!');
    }

    public function edit($id)
    {
        $section = Section::findOrFail($id);
        return view('dashboard.admin.section.btn.edit', ['section' => $section, 'title' => 'تعديل قسم']);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'is_active' => 'nullable|boolean',
        ]);

        $section = Section::findOrFail($id);
        $section->update([
            'name' => $request->name,
            'department_id' => $request->department_id,
            'is_active' => $request->has('is_active') ? 1 : 0,
        ]);
        return redirect()->route('admin.section.index')->with('success', 'تم تحديث القسم بنجاح!');
    }

    public function destroy(Section $section)
    {
        $section->delete();
        return redirect()->route('admin.section.index')->with('success', 'تم الحذف بنجاح!');
    }
}
