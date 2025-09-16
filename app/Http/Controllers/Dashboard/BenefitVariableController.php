<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Repositories\Eloquents\BenefitVariableRepository;
use App\DataTables\Dashboard\Admin\BenefitVariableDataTable;
use Illuminate\Http\Request;
use App\Models\BenefitVariable;

class BenefitVariableController extends Controller
{
    protected $benefitVariableRepository;

    public function __construct(BenefitVariableRepository $benefitVariableRepository)
    {
        $this->benefitVariableRepository = $benefitVariableRepository;
    }

    public function index(BenefitVariableDataTable $dataTable)
    {
        return $this->benefitVariableRepository->index(
            $dataTable,
            'dashboard.admin.benefitVariables.index',
            'متغيرات المزايا'
        );
    }

    public function create()
    {
        return $this->benefitVariableRepository->create(
            'dashboard.admin.benefitVariables.btn.create',
            'إضافة متغير ميزة'
        );
    }

    public function store(Request $request)
    {
        return $this->benefitVariableRepository->store($request);
    }

    public function edit($id)
    {
        return $this->benefitVariableRepository->edit(
            $id,
            'dashboard.admin.benefitVariables.btn.edit',
            'تعديل متغير ميزة'
        );
    }

    public function update(Request $request, $id)
    {
        return $this->benefitVariableRepository->update($request, $id);
    }

    public function destroy(BenefitVariable $benefitVariable)
    {
        return $this->benefitVariableRepository->destroy($benefitVariable);
    }
}
