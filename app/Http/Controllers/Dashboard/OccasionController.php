<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\DataTables\Dashboard\Admin\OccasionDataTable;
use App\Models\Occasion;
use App\Repositories\Contracts\OccasionRepositoryInterface;

class OccasionController extends Controller
{
    public function __construct(protected OccasionDataTable $occasionDataTable, protected OccasionRepositoryInterface $occasionInterface)
    {
        $this->occasionInterface = $occasionInterface;
        $this->occasionDataTable = $occasionDataTable;
    }

    public function index(OccasionDataTable $occasionDataTable)
    {
        return $this->occasionInterface->index($this->occasionDataTable);
    }

    public function create()
    {
        return $this->occasionInterface->create();
    }

    public function store(Request $request)
    {
        return $this->occasionInterface->store($request);
    }

    public function edit($id)
    {
        return $this->occasionInterface->edit($id);
    }

    public function update(Request $request, $id)
    {
        return $this->occasionInterface->update($request, $id);
    }

    public function destroy(Occasion $occasion)
    {
        return $this->occasionInterface->destroy($occasion);
    }
}