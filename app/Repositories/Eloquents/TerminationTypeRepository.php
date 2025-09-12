<?php

namespace  App\Repositories\Eloquents;

use App\Models\TerminationType;
use App\Repositories\Contracts\TerminationTypeRepositoryInterface;
use Illuminate\Http\Request;
use App\DataTables\Dashboard\Admin\TerminationTypeDataTable;

class TerminationTypeRepository implements TerminationTypeRepositoryInterface
{
    public function index(TerminationTypeDataTable $terminationTypeDataTable)
    {
        return $terminationTypeDataTable->render('dashboard.admin.terminationTypes.index', ['title' => 'انواع ترك العمل']);
    }

    public function create()
    {
        return view('dashboard.admin.terminationTypes.btn.create', ['title' => 'إضافة نوع']);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'is_active' => 'nullable|boolean',
        ]);
        TerminationType::create([
            'name' => $request->name,
            'is_active' => $request->has('is_active'),
        ]);
        return redirect()->route('admin.terminationTypes.index')->with('success', 'تم حفظ نوع بنجاح!');
    }

    public function edit($id)
    {
        $terminationType = TerminationType::findOrFail($id);
        return view('dashboard.admin.terminationTypes.btn.edit', ['terminationType' => $terminationType, 'title' => 'تعديل النوع']);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'is_active' => 'nullable|boolean',
        ]);

        $terminationType = TerminationType::findOrFail($id);
        $terminationType->update([
            'name' => $request->name,
            'is_active' => $request->has('is_active') ? 1 : 0,
        ]);
        return redirect()->route('admin.terminationTypes.index')->with('success', 'تم تحديث النوع بنجاح!');
    }

    public function destroy(TerminationType $terminationType)
    {
        $terminationType->delete();
        return redirect()->route('admin.terminationTypes.index')->with('success', 'تم الحذف بنجاح!');
    }
}
