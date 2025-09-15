<?php
namespace App\Observers;
use App\Models\Branch;
class BranchObserver {
    public function creating(Branch $branch) {
        $user = get_user_data();
        if ($user && $user->company_id) {
            $branch->company_id = $user->company_id;
            $branch->added_by_id = $user->id;
        }
    }

    public function updating(Branch $branch)
    {
        $user = get_user_data();
        if ($user && $user->company_id) {
            $branch->company_id = $user->company_id;
            $branch->updated_by_id = $user->id;
        }
    }
}