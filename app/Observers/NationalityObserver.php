<?php

namespace App\Observers;

use App\Models\Nationality;
class NationalityObserver
{
    public function creating(Nationality $nationality)
    {
        $user = get_user_data();
        if ($user && $user->company_id) {
            $nationality->company_id = $user->company_id;
            $nationality->added_by_id = $user->id;
        }
    }

    public function updating(Nationality $nationality)
    {
        $user = get_user_data();
        if ($user && $user->company_id) {
            $nationality->company_id = $user->company_id;
            $nationality->updated_by_id = $user->id;
        }
    }
}