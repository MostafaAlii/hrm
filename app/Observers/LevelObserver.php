<?php

namespace App\Observers;

use App\Models\Level;

class LevelObserver
{
    public function creating(Level $level)
    {
        $user = get_user_data();
        if ($user && $user->company_id) {
            $level->company_id = $user->company_id;
            $level->added_by_id = $user->id;
        }
    }

    public function updating(Level $level)
    {
        $user = get_user_data();
        if ($user && $user->company_id) {
            $level->company_id = $user->company_id;
            $level->updated_by_id = $user->id;
        }
    }
}