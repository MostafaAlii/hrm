<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\DataTables\Dashboard\Admin\LevelDataTable;
use App\Models\Level;
use App\Repositories\Contracts\LevelRepositoryInterface;

class LevelController extends Controller
{
    public function __construct(protected LevelDataTable $levelDataTable, protected LevelRepositoryInterface $levelInterface)
    {
        $this->levelInterface = $levelInterface;
        $this->levelDataTable = $levelDataTable;
    }

    public function index(LevelDataTable $levelDataTable)
    {
        return $this->levelInterface->index($this->levelDataTable);
    }

    public function create()
    {
        return $this->levelInterface->create();
    }

    public function store(Request $request)
    {
        return $this->levelInterface->store($request);
    }

    public function edit($id)
    {
        return $this->levelInterface->edit($id);
    }

    public function update(Request $request, $id)
    {
        return $this->levelInterface->update($request, $id);
    }

    public function destroy(Level $level)
    {
        return $this->levelInterface->destroy($level);
    }
}