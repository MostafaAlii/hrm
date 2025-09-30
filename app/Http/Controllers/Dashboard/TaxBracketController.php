<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Repositories\Contracts\TaxBracketRepositoryInterface;
use Illuminate\Http\Request;

class TaxBracketController extends Controller
{
    public function __construct(protected TaxBracketRepositoryInterface $repository) {}

    public function store(Request $request)
    {
        return $this->repository->store($request);
    }

    public function update(Request $request, $id) {
        return $this->repository->update($request, $id);
    }

    public function destroy($id)
    {
        $record = $this->repository->find($id);
        return $this->repository->destroy($record);
    }
}