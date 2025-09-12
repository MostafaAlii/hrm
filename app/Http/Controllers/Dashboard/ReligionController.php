<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\DataTables\Dashboard\Admin\ReligionDataTable;
use App\Models\Religion;
use App\Repositories\Contracts\ReligionRepositoryInterface;

class ReligionController extends Controller
{
    public function __construct(protected ReligionDataTable $religionDataTable, protected ReligionRepositoryInterface $religionInterface)
    {
        $this->religionInterface = $religionInterface;
        $this->religionDataTable = $religionDataTable;
    }

    public function index(ReligionDataTable $religionDataTable)
    {
        return $this->religionInterface->index($this->religionDataTable);
    }

    public function create()
    {
        return $this->religionInterface->create();
    }

    public function store(Request $request)
    {
        return $this->religionInterface->store($request);
    }

    public function edit($id)
    {
        return $this->religionInterface->edit($id);
    }

    public function update(Request $request, $id)
    {
        return $this->religionInterface->update($request, $id);
    }

    public function destroy(Religion $religion)
    {
        return $this->religionInterface->destroy($religion);
    }
}