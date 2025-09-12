<?php

namespace  App\Repositories\Eloquents;

use App\Models\Religion;
use App\Repositories\Contracts\ReligionRepositoryInterface;
use Illuminate\Http\Request;
use App\DataTables\Dashboard\Admin\ReligionDataTable;

class ReligionRepository implements ReligionRepositoryInterface
{
    public function index(ReligionDataTable $terminationTypeDataTable)
    {
        return $terminationTypeDataTable->render('dashboard.admin.religion.index', ['title' => 'الديانات']);
    }

    public function create()
    {
        return view('dashboard.admin.religion.btn.create', ['title' => 'إضافة ديانه']);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'is_active' => 'nullable|boolean',
        ]);
        Religion::create([
            'name' => $request->name,
            'is_active' => $request->has('is_active'),
        ]);
        return redirect()->route('admin.religion.index')->with('success', 'تم حفظ ديانه بنجاح!');
    }

    public function edit($id)
    {
        $religion = Religion::findOrFail($id);
        return view('dashboard.admin.religion.btn.edit', ['religion' => $religion, 'title' => 'تعديل ديانه']);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'is_active' => 'nullable|boolean',
        ]);

        $religion = Religion::findOrFail($id);
        $religion->update([
            'name' => $request->name,
            'is_active' => $request->has('is_active') ? 1 : 0,
        ]);
        return redirect()->route('admin.religion.index')->with('success', 'تم تحديث ديانه بنجاح!');
    }

    public function destroy(Religion $religion)
    {
        $religion->delete();
        return redirect()->route('admin.religion.index')->with('success', 'تم الحذف بنجاح!');
    }
}