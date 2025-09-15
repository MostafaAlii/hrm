<?php

namespace App\Repositories\Contracts;

use App\DataTables\Dashboard\Admin\SectionDataTable;
use Illuminate\Http\Request;
use App\Models\Section;

interface SectionRepositoryInterface
{
    public function index(SectionDataTable $sectionDataTable);
    public function create();
    public function store(Request $request);
    public function edit($id);
    public function update(Request $request, $id);
    public function destroy(Section $section);
}
