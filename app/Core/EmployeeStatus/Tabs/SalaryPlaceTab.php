<?php

namespace App\Core\EmployeeStatus\Tabs;

use App\Models\SalaryPlace;
use App\Models\Employee;
use App\Core\EmployeeStatus\Enums\EmployeeStatusTabType;
use App\Core\EmployeeStatus\EmployeeStatusTab;

class SalaryPlaceTab implements EmployeeStatusTab
{
    public function key(): string
    {
        return 'salary_place';
    }

    public function type(): EmployeeStatusTabType
    {
        return EmployeeStatusTabType::SELECT;
    }

    public function title(): string
    {
        return trans('dashboard/sidebar.salary_place_sidebar_title');
    }

    public function employeeField(): string
    {
        return 'salary_place_id';
    }

    public function from(Employee $employee): ?string
    {
        return $employee->salaryPlace?->name;
    }

    public function options(): iterable
    {
        return SalaryPlace::active()->select(['id', 'name'])->get();
    }
    
    public function model(): string
    {
        return SalaryPlace::class;
    }
}