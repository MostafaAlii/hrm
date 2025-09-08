<?php

namespace App\Observers;

use App\Models\FinancialYear;

class FinancialYearObserver
{
    public function creating(FinancialYear $financialYear): void
    {
        $user = get_user_data();
        if ($user) {
            if ($user->company_id) {
                $financialYear->company_id = $user->company_id;
            }
            $financialYear->added_by_id = $user->id;
        }
    }

    public function updating(FinancialYear $financialYear): void
    {
        $user = get_user_data();
        if ($user) {
            $financialYear->updated_by_id = $user->id;
        }
    }
}