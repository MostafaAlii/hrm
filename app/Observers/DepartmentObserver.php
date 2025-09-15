<?php

namespace App\Observers;

use App\Models\Department;

class DepartmentObserver
{
    public function creating(Department $department)
    {
        $user = get_user_data();
        if ($user && $user->company_id) {
            $department->company_id = $user->company_id;
            $department->added_by_id = $user->id;
        }
    }

    public function updating(Department $department)
    {
        $user = get_user_data();
        if ($user && $user->company_id) {
            $department->company_id = $user->company_id;
            $department->updated_by_id = $user->id;
        }
    }
}