<?php
namespace App\Repositories\Contracts;
use App\DataTables\Dashboard\Admin\FinancialYearDataTable;
use App\Http\Requests\Dashboard\Financial\FinancialYearRequest;
use Illuminate\Http\Request;
use App\Models\FinancialYear;
interface FinancialYearRepositoryInterface {
    public function index(FinancialYearDataTable $financialYearDataTable);
    public function store(FinancialYearRequest $request);
    public function find(int $id);
    public function getMonths(FinancialYear $financialYear);
    public function update(int $id, array $data): bool;
    public function delete(int $id): bool;
}