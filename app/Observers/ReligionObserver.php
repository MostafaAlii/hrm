<?php

namespace App\Observers;

use App\Models\Religion;

class ReligionObserver
{
    public function creating(Religion $religion)
    {
        $user = get_user_data();
        if ($user && $user->company_id) {
            $religion->company_id = $user->company_id;
            $religion->added_by_id = $user->id;
        }
    }

    public function updating(Religion $religion)
    {
        $user = get_user_data();
        if ($user && $user->company_id) {
            $religion->company_id = $user->company_id;
            $religion->updated_by_id = $user->id;
        }
    }
}