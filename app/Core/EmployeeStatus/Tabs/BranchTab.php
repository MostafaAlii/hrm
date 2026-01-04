<?php

namespace App\Core\EmployeeStatus\Tabs;

use App\Models\Branch;
use App\Models\Employee;
use App\Core\EmployeeStatus\Enums\EmployeeStatusTabType;
use App\Core\EmployeeStatus\EmployeeStatusTab;

class BranchTab implements EmployeeStatusTab
{
    public function key(): string
    {
        return 'branch';
    }

    public function type(): EmployeeStatusTabType
    {
        return EmployeeStatusTabType::SELECT;
    }

    public function title(): string
    {
        return trans('dashboard/sidebar.branch_sidebar_title');
    }

    public function employeeField(): string
    {
        return 'branch_id';
    }

    public function from(Employee $employee): ?string
    {
        return $employee->branch?->name;
    }

    public function options(): iterable
    {
        return Branch::active()->select(['id', 'name'])->get();
    }

    public function model(): string
    {
        return Branch::class;
    }
}