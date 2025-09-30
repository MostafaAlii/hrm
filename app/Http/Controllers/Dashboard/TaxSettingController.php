<?php

namespace App\Http\Controllers\Dashboard;

use App\DataTables\Dashboard\Admin\TaxSettingDataTable;
use App\Http\Controllers\Controller;
use App\Repositories\Contracts\TaxSettingRepositoryInterface;
use Illuminate\Http\Request;

class TaxSettingController extends Controller {
    public function __construct(protected TaxSettingRepositoryInterface $repository) {}
    public function index() {
        //$taxSetting = \App\Models\TaxSetting::with('taxBrackets')->where('company_id', get_user_data()->company_id)->first();
        /*return view('dashboard.admin.settings.tax-settings.index', [
            'title' => 'اعدادات الضرائب',
            'taxSetting' => $taxSetting
        ]);*/
        return $this->repository->indexView('dashboard.admin.settings.tax-settings.index', 'اعدادات الضرائب');
    }

    public function create()
    {
        return $this->repository->create('dashboard.admin.tax-settings.create', 'اعدادات الضرائب');
    }

    public function store(Request $request)
    {
        return $this->repository->store($request);
    }

    public function edit($id)
    {
        return $this->repository->edit($id, 'dashboard.admin.tax-settings.edit', 'اعدادات الضرائب');
    }

    public function update(Request $request, $id)
    {
        return $this->repository->update($request, $id);
    }

    public function destroy($id)
    {
        $record = $this->repository->find($id);
        return $this->repository->destroy($record);
    }
}
