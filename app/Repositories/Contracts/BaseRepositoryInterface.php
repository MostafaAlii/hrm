<?php
namespace App\Repositories\Contracts;
use Illuminate\Http\Request;
interface BaseRepositoryInterface {
    public function index($dataTable, $view, $title);
    public function create($view, $title);
    public function store(Request $request);
    public function edit($id, $view, $title);
    public function update(Request $request, $id);
    public function destroy($model);
}
