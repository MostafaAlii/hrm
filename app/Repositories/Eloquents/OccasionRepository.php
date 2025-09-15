<?php

namespace  App\Repositories\Eloquents;

use App\Models\Occasion;
use App\Repositories\Contracts\OccasionRepositoryInterface;
use Illuminate\Http\Request;
use App\DataTables\Dashboard\Admin\OccasionDataTable;

class OccasionRepository implements OccasionRepositoryInterface
{
    public function index(OccasionDataTable $occasionDataTable)
    {
        return $occasionDataTable->render('dashboard.admin.occasions.index', ['title' => 'المناسبات الرسميه']);
    }

    public function create()
    {
        return view('dashboard.admin.occasions.btn.create', ['title' => 'إضافة مناسبه']);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'is_active' => 'nullable|boolean',
            'from_date'  => 'required|date',
            'to_date'    => 'nullable|date|after_or_equal:from_date',
        ]);
        $totalDays = $request->to_date
            ? now()->parse($request->from_date)->diffInDays(now()->parse($request->to_date)) + 1
            : 1;
        Occasion::create([
            'name'       => $request->name,
            'from_date'  => $request->from_date,
            'to_date'    => $request->to_date ?? $request->from_date,
            'total_days' => $totalDays,
            'is_active'  => $request->boolean('is_active'),
        ]);
        return redirect()->route('admin.occasions.index')->with('success', 'تم حفظ المناسبه بنجاح!');
    }

    public function edit($id)
    {
        $occasion = Occasion::findOrFail($id);
        return view('dashboard.admin.occasions.btn.edit', ['occasion' => $occasion, 'title' => 'تعديل المناسبه']);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'is_active' => 'nullable|boolean',
        ]);

        $occasion = Occasion::findOrFail($id);
        $totalDays = $request->to_date
            ? now()->parse($request->from_date)->diffInDays(now()->parse($request->to_date)) + 1
            : 1;
        $occasion->update([
            'name' => $request->name,
            'is_active' => $request->has('is_active') ? 1 : 0,
            'name'       => $request->name,
            'from_date'  => $request->from_date,
            'to_date'    => $request->to_date ?? $request->from_date,
            'total_days' => $totalDays,
        ]);
        return redirect()->route('admin.occasions.index')->with('success', 'تم تحديث المناسبه بنجاح!');
    }

    public function destroy(Occasion $occasion)
    {
        $occasion->delete();
        return redirect()->route('admin.occasions.index')->with('success', 'تم الحذف بنجاح!');
    }
}