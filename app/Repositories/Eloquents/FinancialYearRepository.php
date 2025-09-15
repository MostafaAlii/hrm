<?php

namespace App\Repositories\Eloquents;
use App\Models\{FinancialYear};
use App\Repositories\Contracts\FinancialYearRepositoryInterface;
use Illuminate\Http\Request;
use App\DataTables\Dashboard\Admin\FinancialYearDataTable;
use App\Http\Requests\Dashboard\Financial\FinancialYearRequest;
class FinancialYearRepository implements FinancialYearRepositoryInterface {
    public function index(FinancialYearDataTable $financialYearDataTable) {
        return $financialYearDataTable->render('dashboard.admin.financial.financialYear.index', [
            'title' => trans('dashboard/sidebar.admin_financialYearMonths_sidebar_title'),
        ]);
    }

    public function store(FinancialYearRequest $request) {
        $data = $request->validated();
        $financialYear = FinancialYear::create($data);
        $start = $financialYear->start_date->copy()->startOfMonth();
        $end   = $financialYear->end_date->copy()->endOfMonth();
        $months = [];
        $current = $start->copy();
        while ($current->lte($end)) {
            $monthStart = $current->copy()->startOfMonth();
            $monthEnd   = $current->copy()->endOfMonth();
            $isCurrentMonth = $monthStart->isSameMonth(now());
            $months[] = [
                'financial_year_id' => $financialYear->id,
                'name' => $monthStart->translatedFormat('F'),
                'number_of_days' => $monthStart->daysInMonth,
                'year_and_month' => $monthStart->format('Y-m'),
                'start_date' => $monthStart,
                'end_date' => $monthEnd,
                'fingerprint_start_date' => $monthStart,
                'fingerprint_end_date' => $monthEnd,
                'is_closed' => !$isCurrentMonth,
                'company_id' => $financialYear->company_id,
                'added_by_id' => get_user_data()?->id,
                'created_at' => now(),
                'updated_at' => now(),
            ];
            $current->addMonth();
        }
        $financialYear->months()->insert($months);
        return redirect()
            ->route('admin.financialYears.index')
            ->with('success', trans('dashboard/general.created_successfully'));
    }

    public function find(int $id) {
        $financialYear = FinancialYear::find($id);
        return view('dashboard.admin.financial.financialYear.btn.edit', compact('financialYear'));
    }

    public function update(int $id, array $data): bool {
        $financialYear = FinancialYear::find($id);
        if (!$financialYear) {
            return false;
        }
        return $financialYear->update($data);
    }

    public function delete(int $id): bool {
        $financialYear = FinancialYear::find($id);
        if (!$financialYear) {
            return false;
        }
        if ($financialYear->is_active || $financialYear->start_date->year == now()->year) {
            return false;
        }
        $financialYear->months()->delete();
        return $financialYear->delete();
    }


    public function getMonths(FinancialYear $financialYear) {
        $months = $financialYear->months()->with(['addedBy', 'updatedBy'])->orderBy('start_date')->get();
        return view('dashboard.admin.financial.financialYear.btn.months', compact('financialYear', 'months'));
    }
}