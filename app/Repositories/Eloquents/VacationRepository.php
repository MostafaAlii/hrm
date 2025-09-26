<?php

namespace  App\Repositories\Eloquents;

use App\Models\Vacation;
use App\Repositories\Contracts\VacationRepositoryInterface;
use Illuminate\Http\Request;
use App\DataTables\Dashboard\Admin\VacationDataTable;

class VacationRepository implements VacationRepositoryInterface
{
    public function index(VacationDataTable $vacationDataTable)
    {
        return $vacationDataTable->render('dashboard.admin.vacations.index', ['title' => 'الاجازات']);
    }

    public function create()
    {
        return view('dashboard.admin.vacations.btn.create', ['title' => 'إضافة اجازه']);
    }

    public function store(Request $request) {
        $request->validate([
            'name_ar' => 'required|string|max:255',
            'name_en' => 'nullable|string|max:255',
            'color'   => 'nullable|string|max:50',
            'balance' => 'nullable|integer|min:0',
            'ten_years_balance'   => 'nullable|integer|min:0',
            'fifty_years_balance' => 'nullable|integer|min:0',
        ]);

        Vacation::create([
            'name_ar'             => $request->name_ar,
            'name_en'             => $request->name_en,
            'color'               => $request->color,
            'code'               => $request->code,
            'deduct_from_balance' => $request->boolean('deduct_from_balance'),
            'deduction_value'     => $request->deduction_value,
            'balance'             => $request->balance ?? 0,
            'ten_years_balance'   => $request->ten_years_balance ?? 0,
            'fifty_years_balance' => $request->fifty_years_balance ?? 0,
            'can_be_carried_forward' => $request->boolean('can_be_carried_forward'),
            'affects_ten_years'      => $request->boolean('affects_ten_years'),
            'affects_fifty_years'    => $request->boolean('affects_fifty_years'),
            'affects_annual_leave'   => $request->boolean('affects_annual_leave'),
        ]);

        return redirect()
            ->route('admin.vacations.index')
            ->with('success', 'تم حفظ الإجازة بنجاح!');
    }


    public function edit($id)
    {
        $vacation = Vacation::findOrFail($id);
        return view('dashboard.admin.vacations.btn.edit', ['vacation' => $vacation, 'title' => 'تعديل الاجازه']);
    }

    public function update(Request $request, $id) {
        $request->validate([
            'name_ar' => 'required|string|max:255',
            'name_en' => 'nullable|string|max:255',
            'code' => 'required|string|max:255',
            'color'   => 'nullable|string|max:50',
            'balance' => 'nullable|integer|min:0',
            'ten_years_balance'   => 'nullable|integer|min:0',
            'fifty_years_balance' => 'nullable|integer|min:0',
        ]);

        $vacation = Vacation::findOrFail($id);

        $vacation->update([
            'name_ar'             => $request->name_ar,
            'name_en'             => $request->name_en,
            'color'               => $request->color,
            'code'               => $request->code,
            'deduct_from_balance' => $request->boolean('deduct_from_balance'),
            'deduction_value'     => $request->deduction_value,
            'balance'             => $request->balance ?? 0,
            'ten_years_balance'   => $request->ten_years_balance ?? 0,
            'fifty_years_balance' => $request->fifty_years_balance ?? 0,
            'can_be_carried_forward' => $request->boolean('can_be_carried_forward'),
            'affects_ten_years'      => $request->boolean('affects_ten_years'),
            'affects_fifty_years'    => $request->boolean('affects_fifty_years'),
            'affects_annual_leave'   => $request->boolean('affects_annual_leave'),
            'updated_by_id'          => auth()->guard('admin')->id(),
        ]);

        return redirect()
            ->route('admin.vacations.index')
            ->with('success', 'تم تحديث الإجازة بنجاح!');
    }


    public function destroy(Vacation $vacation)
    {
        $vacation->delete();
        return redirect()->route('admin.vacations.index')->with('success', 'تم الحذف بنجاح!');
    }
}
