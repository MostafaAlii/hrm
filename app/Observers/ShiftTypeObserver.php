<?php

namespace App\Observers;

use App\Models\ShiftType;

class ShiftTypeObserver {
    public function creating(ShiftType $shiftType)
    {
        $user = get_user_data();
        if ($user && $user->company_id) {
            $shiftType->company_id = $user->company_id;
            $shiftType->added_by_id = $user->id;
        }
    }

    public function updating(ShiftType $shiftType)
    {
        $user = get_user_data();
        if ($user && $user->company_id) {
            $shiftType->company_id = $user->company_id;
            $shiftType->updated_by_id = $user->id;
        }
        if (
            $shiftType->isDirty('type') &&
            $shiftType->type->value === \App\Enums\ShiftType\ShiftType::FLEXIBLE->value
        ) {
            $shiftType->from_time = "00:00:00";
            $shiftType->to_time = "00:00:00";
        }
    }
}
