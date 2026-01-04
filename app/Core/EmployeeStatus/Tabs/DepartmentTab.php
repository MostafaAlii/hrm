<?php

namespace App\Core\EmployeeStatus\Tabs;

use App\Models\Department;
use App\Models\Employee;
use App\Core\EmployeeStatus\Enums\EmployeeStatusTabType;
use App\Core\EmployeeStatus\EmployeeStatusTab;

class DepartmentTab implements EmployeeStatusTab
{
    public function key(): string
    {
        return 'department';
    }

    public function type(): EmployeeStatusTabType
    {
        return EmployeeStatusTabType::SELECT;
    }

    public function title(): string
    {
        return trans('dashboard/sidebar.department_sidebar_title');
    }

    public function employeeField(): string
    {
        return 'department_id';
    }

    public function from(Employee $employee): ?string
    {
        return $employee->department?->name;
    }

    public function options(): iterable
    {
        return Department::active()->select(['id', 'name'])->get();
    }
    
    public function model(): string
    {
        return Department::class;
    }
}