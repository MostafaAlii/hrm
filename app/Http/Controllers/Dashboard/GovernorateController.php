<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Repositories\Eloquents\GovernorateRepository;
use App\DataTables\Dashboard\Admin\GovernorateDataTable;
use Illuminate\Http\Request;
use App\Models\Governorate;

class GovernorateController extends Controller
{
    protected $repository;

    public function __construct(GovernorateRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index(GovernorateDataTable $dataTable)
    {
        return $this->repository->index(
            $dataTable,
            'dashboard.admin.governorates.index',
            'متغيرات المحافظات'
        );
    }

    public function create()
    {
        return $this->repository->create(
            'dashboard.admin.governorates.btn.create',
            'إضافة محافظه'
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
            'dashboard.admin.governorates.btn.edit',
            'تعديل محافظه'
        );
    }

    public function update(Request $request, $id)
    {
        return $this->repository->update($request, $id);
    }

    public function destroy(Governorate $governorate)
    {
        return $this->repository->destroy($governorate);
    }
}
