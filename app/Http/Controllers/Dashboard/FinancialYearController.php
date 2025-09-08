<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\DataTables\Dashboard\Admin\FinancialYearDataTable;
use App\Repositories\Contracts\FinancialYearRepositoryInterface;
use App\Models\FinancialYear;
use App\Http\Requests\Dashboard\Financial\FinancialYearRequest;
class FinancialYearController extends Controller {
    public function __construct(protected FinancialYearDataTable $financialYearDataTable, protected FinancialYearRepositoryInterface $financialYearInterface)
    {
        $this->financialYearInterface = $financialYearInterface;
        $this->financialYearDataTable = $financialYearDataTable;
    }

    public function index(FinancialYearDataTable $financialYearDataTable)
    {
        return $this->financialYearInterface->index($this->financialYearDataTable);
    }

    public function store(FinancialYearRequest $request)
    {
        return $this->financialYearInterface->store($request);
    }

    public function edit($id)
    {
        return $this->financialYearInterface->find($id);
    }

    public function update(FinancialYearRequest $request, $id) {
        $data = $request->validated();
        $updated = $this->financialYearInterface->update($id, $data);
        if (!$updated) {
            return response()->json([
                'status' => 'error',
                'message' => trans('dashboard/general.update_failed')
            ], 422);
        }

        return response()->json([
            'status' => 'success',
            'message' => trans('dashboard/general.updated_successfully')
        ]);
    }

    public function destroy($id) {
        $deleted = $this->financialYearInterface->delete($id);
        if (!$deleted) {
            return redirect()->back()->with('error', 'لا يمكن حذف هذه السنة لأنها مفعلة أو هي السنة الحالية.');
        }
        return redirect()->back()->with('success', 'تم حذف السنة المالية بنجاح.');
    }



    public function months(FinancialYear $financialYear)
    {
        return $this->financialYearInterface->getMonths($financialYear);
    }
}