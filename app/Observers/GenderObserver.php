<?php

namespace App\Observers;

use App\Models\Gender;

class GenderObserver
{
    public function creating(Gender $gender)
    {
        $user = get_user_data();
        if ($user && $user->company_id) {
            $gender->company_id = $user->company_id;
            $gender->added_by_id = $user->id;
        }
    }

    public function updating(Gender $gender)
    {
        $user = get_user_data();
        if ($user && $user->company_id) {
            $gender->company_id = $user->company_id;
            $gender->updated_by_id = $user->id;
        }
    }
}