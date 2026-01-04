<?php

namespace App\Core\EmployeeStatus\Tabs;

use App\Core\EmployeeStatus\EmployeeStatusTab;
use App\Models\Employee;
use App\Models\Section;
use App\Core\EmployeeStatus\Enums\EmployeeStatusTabType;
class SectionTab implements EmployeeStatusTab
{
    public function type(): EmployeeStatusTabType
    {
        return EmployeeStatusTabType::SELECT;
    }
    public function employeeField(): string
    {
        return 'section_id';
    }


    public function model(): string
    {
        return Section::class;
    }

    public function key(): string
    {
        return 'section';
    }

    public function title(): string
    {
        return trans('dashboard/sidebar.admin_section_sidebar_title');
    }

    public function from(Employee $employee): ?string
    {
        return $employee->section?->name;
    }

    public function options(): iterable
    {
        return Section::active()->select(['id', 'name'])->get();
    }
}