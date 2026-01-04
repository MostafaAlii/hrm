<?php

namespace App\Core\EmployeeStatus\Tabs;

use App\Models\Level;
use App\Models\Employee;
use App\Core\EmployeeStatus\Enums\EmployeeStatusTabType;
use App\Core\EmployeeStatus\EmployeeStatusTab;

class LevelTab implements EmployeeStatusTab
{
    public function key(): string
    {
        return 'level';
    }

    public function type(): EmployeeStatusTabType
    {
        return EmployeeStatusTabType::SELECT;
    }

    public function title(): string
    {
        return trans('dashboard/sidebar.level_sidebar_title');
    }

    public function employeeField(): string
    {
        return 'level_id';
    }

    public function from(Employee $employee): ?string
    {
        return $employee->level?->name;
    }

    public function options(): iterable
    {
        return Level::active()->select(['id', 'name'])->get();
    }

    public function model(): string
    {
        return Level::class;
    }
}