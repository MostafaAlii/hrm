<?php

namespace App\Observers;

use App\Models\Vacation;
class VacationObserver
{
    public function creating(Vacation $vacation)
    {
        $user = get_user_data();
        if ($user && $user->company_id) {
            $vacation->company_id = $user->company_id;
            $vacation->added_by_id = $user->id;
        }
    }

    public function updating(Vacation $vacation)
    {
        $user = get_user_data();
        if ($user && $user->company_id) {
            $vacation->company_id = $user->company_id;
            $vacation->updated_by_id = $user->id;
        }
    }
}