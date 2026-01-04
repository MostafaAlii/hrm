<?php
namespace App\Core\EmployeeStatus;
use App\Core\EmployeeStatus\Tabs\{JobTab, SectionTab, DepartmentTab, BranchTab, LevelTab, SalaryPlaceTab};

class EmployeeStatusTabManager
{
    public static function all(): array
    {
        return [
            new JobTab(),
            new SectionTab(),
            new DepartmentTab(),
            new BranchTab(),
            new LevelTab(),
            new SalaryPlaceTab(),
        ];
    }
}