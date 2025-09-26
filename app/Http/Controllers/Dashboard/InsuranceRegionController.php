<?php

namespace App\Http\Controllers\Dashboard;

use App\DataTables\Dashboard\Admin\InsuranceRegionDataTable;
use App\Http\Controllers\Controller;
use App\Repositories\Contracts\InsuranceRegionRepositoryInterface;
use Illuminate\Http\Request;

class InsuranceRegionController extends Controller
{
    private InsuranceRegionRepositoryInterface $insuranceRegionRepo;

    public function __construct(InsuranceRegionRepositoryInterface $insuranceRegionRepo)
    {
        $this->insuranceRegionRepo = $insuranceRegionRepo;
    }

    public function index(InsuranceRegionDataTable $dataTable)
    {
        return $this->insuranceRegionRepo->index($dataTable, 'dashboard.admin.insurance_regions.index', 'مناطق التأمين');
    }

    public function create()
    {
        return $this->insuranceRegionRepo->create('dashboard.admin.insurance_regions.create', 'إضافة منطقة تأمين');
    }

    public function store(Request $request)
    {
        return $this->insuranceRegionRepo->store($request);
    }

    public function edit($id)
    {
        return $this->insuranceRegionRepo->edit($id, 'dashboard.admin.insurance_regions.edit', 'تعديل منطقة التأمين');
    }

    public function update(Request $request, $id)
    {
        return $this->insuranceRegionRepo->update($request, $id);
    }

    public function destroy($id)
    {
        $model = app(\App\Models\InsuranceRegion::class)->findOrFail($id);
        return $this->insuranceRegionRepo->destroy($model);
    }
}
