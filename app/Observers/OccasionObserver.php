<?php

namespace App\Observers;

use App\Models\Occasion;

class OccasionObserver
{
    public function creating(Occasion $occasion)
    {
        $user = get_user_data();
        if ($user && $user->company_id) {
            $occasion->company_id = $user->company_id;
            $occasion->added_by_id = $user->id;
        }
    }

    public function updating(Occasion $occasion)
    {
        $user = get_user_data();
        if ($user && $user->company_id) {
            $occasion->company_id = $user->company_id;
            $occasion->updated_by_id = $user->id;
        }
    }
}