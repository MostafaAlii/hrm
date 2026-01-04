<?php
namespace App\Listeners;
use App\Events\EmployeeStatusChanged;
use App\Core\EmployeeStatus\EmployeeStatusTabManager;
use Carbon\Carbon;
class UpdateEmployeeField {
    public function handle(EmployeeStatusChanged $event) {
        $status = $event->status;
        if (!Carbon::parse($status->effective_date)->isToday()) {
            return;
        }

        $employee = $status->employee;
        $tab = collect(EmployeeStatusTabManager::all())->first(fn($t) => $t->key() === $status->type);
        if (!$tab) return;
        $field = $tab->employeeField();
        $employee->{$field} = $status->to_id;
        $employee->save();
        $status->applied = true;
        $status->save();
    }
}