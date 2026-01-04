<?php
namespace App\Core\EmployeeStatus\Tabs;
use App\Core\EmployeeStatus\EmployeeStatusTab;
use App\Models\Employee;
use App\Models\JobCategory;
use App\Core\EmployeeStatus\Enums\EmployeeStatusTabType;
class JobTab implements EmployeeStatusTab {
    public function type(): EmployeeStatusTabType
    {
        return EmployeeStatusTabType::SELECT;
    }

    public function employeeField(): string
    {
        return 'job_category_id';
    }

    public function model(): string
    {
        return JobCategory::class;
    }

    public function key(): string
    {
        return 'job';
    }

    public function title(): string
    {
        return trans('dashboard/sidebar.admin_jobCategory_sidebar_title');
    }

    public function from(Employee $employee): ?string
    {
        return $employee->jobCategory?->name;
    }

    public function options(): iterable
    {
        return JobCategory::active()->select(['id', 'name'])->get();
    }
}