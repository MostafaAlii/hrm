<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Repositories\Eloquents\BloodTypeRepository;
use App\DataTables\Dashboard\Admin\BloodTypeDataTable;
use Illuminate\Http\Request;
use App\Models\BloodType;

class BloodTypeController extends Controller
{
    protected $repository;

    public function __construct(BloodTypeRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index(BloodTypeDataTable $dataTable)
    {
        return $this->repository->index(
            $dataTable,
            'dashboard.admin.bloodTypes.index',
            'متغيرات فصائل الدم'
        );
    }

    public function create()
    {
        return $this->repository->create(
            'dashboard.admin.bloodTypes.btn.create',
            'إضافة متغير ميزة'
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
            'dashboard.admin.bloodTypes.btn.edit',
            'تعديل متغير فصيله دم'
        );
    }

    public function update(Request $request, $id)
    {
        return $this->repository->update($request, $id);
    }

    public function destroy(BloodType $bloodType)
    {
        return $this->repository->destroy($bloodType);
    }
}
