<?php

namespace App\Listeners;
use App\Events\EmployeeSaved;
class SyncEmployeeProfile {
    public function handle(EmployeeSaved $event): void
    {
        $employee = $event->employee;

        $employee->profile()->updateOrCreate(
            ['employee_id' => $employee->id],
            [
                'identify_number' => $employee->identity_number ?? null,
                'birthdate'       => $employee->birthday_date ?? null,
                'gender_id'       => $employee->gender_id ?? null,
                'nationality_id'  => $employee->nationality_id ?? null,
                'religion_id'     => $employee->religion_id ?? null,
                'blood_type_id'   => $employee->blood_type_id ?? null,
                'email'   => $employee->email ?? null,
            ]
        );
    }
}
