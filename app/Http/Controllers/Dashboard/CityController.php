<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Repositories\Eloquents\CityRepository;
use App\DataTables\Dashboard\Admin\CityDataTable;
use Illuminate\Http\Request;
use App\Models\City;

class CityController extends Controller
{
    protected $repository;

    public function __construct(CityRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index(CityDataTable $dataTable)
    {
        return $this->repository->index(
            $dataTable,
            'dashboard.admin.cities.index',
            'متغيرات المدن '
        );
    }

    public function create()
    {
        return $this->repository->create(
            'dashboard.admin.cities.btn.create',
            'إضافة المدن'
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
            'dashboard.admin.cities.btn.edit',
            'تعديل المدن'
        );
    }

    public function update(Request $request, $id)
    {
        return $this->repository->update($request, $id);
    }

    public function destroy(City $city)
    {
        return $this->repository->destroy($city);
    }
}