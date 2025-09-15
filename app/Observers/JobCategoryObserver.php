<?php

namespace App\Observers;

use App\Models\JobCategory;

class JobCategoryObserver
{
    public function creating(JobCategory $jobCategory)
    {
        $user = get_user_data();
        if ($user && $user->company_id) {
            $jobCategory->company_id = $user->company_id;
            $jobCategory->added_by_id = $user->id;
        }
    }

    public function updating(JobCategory $jobCategory)
    {
        $user = get_user_data();
        if ($user && $user->company_id) {
            $jobCategory->company_id = $user->company_id;
            $jobCategory->updated_by_id = $user->id;
        }
    }
}