<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Repositories\Eloquents\CountryRepository;
use App\DataTables\Dashboard\Admin\CountryDataTable;
use Illuminate\Http\Request;
use App\Models\Country;

class CountryController extends Controller
{
    protected $repository;

    public function __construct(CountryRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index(CountryDataTable $dataTable)
    {
        return $this->repository->index(
            $dataTable,
            'dashboard.admin.countries.index',
            'متغيرات الدول '
        );
    }

    public function create()
    {
        return $this->repository->create(
            'dashboard.admin.countries.btn.create',
            'إضافة دوله'
        );
    }

    public function store(Request $request)
    {
        return $this->repository->store($request);
    }

    public function edit($id)
    {
        return $this->repository->edit(
            $id,
            'dashboard.admin.countries.btn.edit',
            'تعديل دوله'
        );
    }

    public function update(Request $request, $id)
    {
        return $this->repository->update($request, $id);
    }

    public function destroy(Country $country)
    {
        return $this->repository->destroy($country);
    }
}
