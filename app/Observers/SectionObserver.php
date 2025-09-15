<?php

namespace App\Observers;

use App\Models\Section;

class SectionObserver {
    public function creating(Section $section) {
        $user = get_user_data();
        if ($user && $user->company_id) {
            $section->company_id = $user->company_id;
            $section->added_by_id = $user->id;
        }
    }

    public function updating(Section $section)
    {
        $user = get_user_data();
        if ($user && $user->company_id) {
            $section->company_id = $user->company_id;
            $section->updated_by_id = $user->id;
        }
    }
}