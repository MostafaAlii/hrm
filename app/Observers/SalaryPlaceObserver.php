<?php

namespace App\Observers;

use App\Models\SalaryPlace;

class SalaryPlaceObserver
{
    public function creating(SalaryPlace $salaryPlace)
    {
        $user = get_user_data();
        if ($user && $user->company_id) {
            $salaryPlace->company_id = $user->company_id;
            $salaryPlace->added_by_id = $user->id;
        }
    }

    public function updating(SalaryPlace $salaryPlace)
    {
        $user = get_user_data();
        if ($user && $user->company_id) {
            $salaryPlace->company_id = $user->company_id;
            $salaryPlace->updated_by_id = $user->id;
        }
    }
}