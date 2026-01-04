<?php
namespace App\Core\EmployeeStatus;
use App\Models\Employee;
use App\Core\EmployeeStatus\Enums\EmployeeStatusTabType;
interface EmployeeStatusTab {
    public function type(): EmployeeStatusTabType;
    public function model(): string;
    public function key(): string;
    public function title(): string;
    public function from(Employee $employee): ?string;
    public function options(): iterable;
}