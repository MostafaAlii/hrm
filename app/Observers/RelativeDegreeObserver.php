<?php

namespace App\Observers;

use App\Models\RelativeDegree;

class RelativeDegreeObserver
{
    public function creating(RelativeDegree $relativeDegree)
    {
        $user = get_user_data();
        if ($user && $user->company_id) {
            $relativeDegree->company_id = $user->company_id;
            $relativeDegree->added_by_id = $user->id;
        }
    }

    public function updating(RelativeDegree $relativeDegree)
    {
        $user = get_user_data();
        if ($user && $user->company_id) {
            $relativeDegree->company_id = $user->company_id;
            $relativeDegree->updated_by_id = $user->id;
        }
    }
}