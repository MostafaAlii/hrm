<?php

namespace  App\Repositories\Eloquents;

use App\Models\Branch;
use App\Repositories\Contracts\BranchRepositoryInterface;
use Illuminate\Http\Request;
use App\DataTables\Dashboard\Admin\BranchDataTable;

class BranchRepository implements BranchRepositoryInterface
{
    public function index(BranchDataTable $branchDataTable)
    {
        return $branchDataTable->render('dashboard.admin.branches.index', ['title' => 'جهه العمل']);
    }

    public function create()
    {
        return view('dashboard.admin.branches.btn.create', ['title' => 'إضافة جهه العمل']);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'nullable|string',
            'phone' => 'nullable|string',
            'is_active' => 'nullable|boolean',
        ]);
        Branch::create([
            'name' => $request->name,
            'address' => $request->address,
            'phone' => $request->phone,
            'is_active' => $request->has('is_active'),
        ]);
        return redirect()->route('admin.branchs.index')->with('success', 'تم حفظ جهه العمل بنجاح!');
    }

    public function edit($id)
    {
        $branch = Branch::findOrFail($id);
        return view('dashboard.admin.branchs.btn.edit', ['branch' => $branch, 'title' => 'تعديل جهه العمل']);
    }

    public function update(Request $request, $id)
    { 
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'nullable|string',
            'phone' => 'nullable|string',
            'is_active' => 'nullable|boolean',
        ]);

        $branch = Branch::findOrFail($id);
        $branch->update([
            'name' => $request->name,
            'address' => $request->address,
            'phone' => $request->phone,
            'is_active' => $request->has('is_active') ? 1 : 0,
        ]);
        return redirect()->route('admin.branchs.index')->with('success', 'تم تحديث جهه العمل بنجاح!');
    }

    public function destroy(Branch $branch)
    {
        $branch->delete();
        return redirect()->route('admin.branchs.index')->with('success', 'تم الحذف بنجاح!');
    }
}