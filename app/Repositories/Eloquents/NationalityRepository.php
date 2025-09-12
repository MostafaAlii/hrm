<?php

namespace  App\Repositories\Eloquents;

use App\Models\Nationality;
use App\Repositories\Contracts\NationalityRepositoryInterface;
use Illuminate\Http\Request;
use App\DataTables\Dashboard\Admin\NationalityDataTable;

class NationalityRepository implements NationalityRepositoryInterface
{
    public function index(NationalityDataTable $terminationTypeDataTable)
    {
        return $terminationTypeDataTable->render('dashboard.admin.nationality.index', ['title' => 'الجنسيات']);
    }

    public function create()
    {
        return view('dashboard.admin.nationality.btn.create', ['title' => 'إضافة جنسيه']);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'is_active' => 'nullable|boolean',
        ]);
        Nationality::create([
            'name' => $request->name,
            'is_active' => $request->has('is_active'),
        ]);
        return redirect()->route('admin.nationality.index')->with('success', 'تم حفظ جنسيه بنجاح!');
    }

    public function edit($id)
    {
        $nationality = Nationality::findOrFail($id);
        return view('dashboard.admin.nationality.btn.edit', ['nationality' => $nationality, 'title' => 'تعديل جنسيه']);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'is_active' => 'nullable|boolean',
        ]);

        $nationality = Nationality::findOrFail($id);
        $nationality->update([
            'name' => $request->name,
            'is_active' => $request->has('is_active') ? 1 : 0,
        ]);
        return redirect()->route('admin.nationality.index')->with('success', 'تم تحديث جنسيه بنجاح!');
    }

    public function destroy(Nationality $nationality)
    {
        $nationality->delete();
        return redirect()->route('admin.nationality.index')->with('success', 'تم الحذف بنجاح!');
    }
}