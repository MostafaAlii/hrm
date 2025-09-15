<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\DataTables\Dashboard\Admin\SectionDataTable;
use App\Models\Section;
use App\Repositories\Contracts\SectionRepositoryInterface;

class SectionController extends Controller
{
    public function __construct(protected SectionDataTable $sectionDataTable, protected SectionRepositoryInterface $sectionInterface)
    {
        $this->sectionInterface = $sectionInterface;
        $this->sectionDataTable = $sectionDataTable;
    }

    public function index(SectionDataTable $sectionDataTable)
    {
        return $this->sectionInterface->index($this->sectionDataTable);
    }

    public function create()
    {
        return $this->sectionInterface->create();
    }

    public function store(Request $request)
    {
        return $this->sectionInterface->store($request);
    }

    public function edit($id)
    {
        return $this->sectionInterface->edit($id);
    }

    public function update(Request $request, $id)
    {
        return $this->sectionInterface->update($request, $id);
    }

    public function destroy(Section $section)
    {
        return $this->sectionInterface->destroy($section);
    }
}