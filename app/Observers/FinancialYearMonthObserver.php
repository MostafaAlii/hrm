<?php

namespace App\Observers;

use App\Models\FinancialYearMonth;

class FinancialYearMonthObserver
{
    public function creating(FinancialYearMonth $month): void
    {
        $user = get_user_data();

        if ($user) {
            if (is_null($month->company_id)) {
                $month->company_id = $user->company_id;
            }

            $month->added_by_id = $user->id;
        }
    }

    public function updating(FinancialYearMonth $month): void
    {
        $user = get_user_data();

        if ($user) {
            $month->updated_by_id = $user->id;
        }
    }
}
