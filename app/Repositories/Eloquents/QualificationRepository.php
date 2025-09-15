<?php

namespace  App\Repositories\Eloquents;

use App\Models\Qualification;
use App\Repositories\Contracts\QualificationRepositoryInterface;
use Illuminate\Http\Request;
use App\DataTables\Dashboard\Admin\QualificationDataTable;

class QualificationRepository implements QualificationRepositoryInterface
{
    public function index(QualificationDataTable $qualificationDataTable)
    {
        return $qualificationDataTable->render('dashboard.admin.qualifications.index', ['title' => 'الموهلات الدراسيه']);
    }

    public function create()
    {
        return view('dashboard.admin.qualifications.btn.create', ['title' => 'إضافة موهل دراسى']);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'is_active' => 'nullable|boolean',
        ]);
        Qualification::create([
            'name' => $request->name,
            'is_active' => $request->has('is_active'),
        ]);
        return redirect()->route('admin.qualifications.index')->with('success', 'تم حفظ الموهل بنجاح!');
    }

    public function edit($id)
    {
        $qualification = Qualification::findOrFail($id);
        return view('dashboard.admin.qualifications.btn.edit', ['qualification' => $qualification, 'title' => 'تعديل الموهل']);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'is_active' => 'nullable|boolean',
        ]);

        $qualification = Qualification::findOrFail($id);
        $qualification->update([
            'name' => $request->name,
            'is_active' => $request->has('is_active') ? 1 : 0,
        ]);
        return redirect()->route('admin.qualifications.index')->with('success', 'تم تحديث الموهل بنجاح!');
    }

    public function destroy(Qualification $qualification)
    {
        $qualification->delete();
        return redirect()->route('admin.qualifications.index')->with('success', 'تم الحذف بنجاح!');
    }
}