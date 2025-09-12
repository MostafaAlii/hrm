<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\DataTables\Dashboard\Admin\NationalityDataTable;
use App\Models\Nationality;
use App\Repositories\Contracts\NationalityRepositoryInterface;

class NationalityController extends Controller
{
    public function __construct(protected NationalityDataTable $nationalityDataTable, protected NationalityRepositoryInterface $nationalityInterface)
    {
        $this->nationalityInterface = $nationalityInterface;
        $this->nationalityDataTable = $nationalityDataTable;
    }

    public function index(NationalityDataTable $nationalityDataTable)
    {
        return $this->nationalityInterface->index($this->nationalityDataTable);
    }

    public function create()
    {
        return $this->nationalityInterface->create();
    }

    public function store(Request $request)
    {
        return $this->nationalityInterface->store($request);
    }

    public function edit($id)
    {
        return $this->nationalityInterface->edit($id);
    }

    public function update(Request $request, $id)
    {
        return $this->nationalityInterface->update($request, $id);
    }

    public function destroy(Nationality $nationality)
    {
        return $this->nationalityInterface->destroy($nationality);
    }
}