<?php

namespace  App\Repositories\Eloquents;

use App\Models\Level;
use App\Repositories\Contracts\LevelRepositoryInterface;
use Illuminate\Http\Request;
use App\DataTables\Dashboard\Admin\LevelDataTable;

class LevelRepository implements LevelRepositoryInterface
{
    public function index(LevelDataTable $levelTypeDataTable)
    {
        return $levelTypeDataTable->render('dashboard.admin.level.index', ['title' => 'المستويات']);
    }

    public function create()
    {
        return view('dashboard.admin.level.btn.create', ['title' => 'إضافة مستوى']);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'is_active' => 'nullable|boolean',
        ]);
        Level::create([
            'name' => $request->name,
            'is_active' => $request->has('is_active'),
        ]);
        return redirect()->route('admin.level.index')->with('success', 'تم حفظ مستوى بنجاح!');
    }

    public function edit($id)
    {
        $level = Level::findOrFail($id);
        return view('dashboard.admin.level.btn.edit', ['level' => $level, 'title' => 'تعديل مستوى']);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'is_active' => 'nullable|boolean',
        ]);

        $level = Level::findOrFail($id);
        $level->update([
            'name' => $request->name,
            'is_active' => $request->has('is_active') ? 1 : 0,
        ]);
        return redirect()->route('admin.level.index')->with('success', 'تم تحديث مستوى بنجاح!');
    }

    public function destroy(Level $level)
    {
        $level->delete();
        return redirect()->route('admin.level.index')->with('success', 'تم الحذف بنجاح!');
    }
}