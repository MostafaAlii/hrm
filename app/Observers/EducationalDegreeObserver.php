<?php

namespace App\Observers;

use App\Models\EducationalDegree;

class EducationalDegreeObserver
{
    public function creating(EducationalDegree $educationalDegree): void
    {
        $user = get_user_data();
        if ($user) {
            if ($user->company_id) {
                $educationalDegree->company_id = $user->company_id;
            }
            $educationalDegree->added_by_id = $user->id;
        }
    }

    public function updating(EducationalDegree $educationalDegree): void
    {
        $user = get_user_data();
        if ($user) {
            $educationalDegree->updated_by_id = $user->id;
        }
    }
}