<?php

namespace App\Observers;

use App\Models\TerminationType;
class TerminationTypeObserver
{
    public function creating(TerminationType $terminationType)
    {
        $user = get_user_data();
        if ($user && $user->company_id) {
            $terminationType->company_id = $user->company_id;
            $terminationType->added_by_id = $user->id;
        }
    }

    public function updating(TerminationType $terminationType)
    {
        $user = get_user_data();
        if ($user && $user->company_id) {
            $terminationType->company_id = $user->company_id;
            $terminationType->updated_by_id = $user->id;
        }
    }
}