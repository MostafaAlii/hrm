<?php

namespace App\Observers;

use App\Models\Qualification;

class QualificationObserver
{
    public function creating(Qualification $qualification)
    {
        $user = get_user_data();
        if ($user && $user->company_id) {
            $qualification->company_id = $user->company_id;
            $qualification->added_by_id = $user->id;
        }
    }

    public function updating(Qualification $qualification)
    {
        $user = get_user_data();
        if ($user && $user->company_id) {
            $qualification->company_id = $user->company_id;
            $qualification->updated_by_id = $user->id;
        }
    }
}