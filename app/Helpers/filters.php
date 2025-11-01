<?php
if (!function_exists('shift_type_labels')) {
    function shift_type_labels() {
        $labels = [];
        foreach (\App\Enums\ShiftType\ShiftType::cases() as $case) {
            $labels[$case->value] = \App\Enums\ShiftType\ShiftType::label($case);
        }
        return $labels;
    }
}

if (!function_exists('all_shift_type_options')) {
    function all_shift_type_options() {
        $companyId = get_user_data()->company_id;
        $options = [];
        if ($companyId) {
            $shifts = \App\Models\ShiftType::where('company_id', $companyId)->get();
            foreach ($shifts as $shift) {
                $options[$shift->id] = \App\Enums\ShiftType\ShiftType::label($shift->type);
            }
        }
        if (empty($options)) {
            foreach (shift_type_labels() as $value => $label) {
                $options[$value] = $label;
            }
        }
        return $options;
    }
}

if (!function_exists('salary_place_options')) {
    function salary_place_options() {
        $companyId = get_user_data()->company_id;
        if (!$companyId) {
            return [];
        }
        return \App\Models\SalaryPlace::where('company_id', $companyId)->get()->pluck('name', 'id')->toArray();
    }
}

if (!function_exists('department_options')) {
    function department_options() {
        $companyId = get_user_data()->company_id;
        if (!$companyId) {
            return [];
        }
        return \App\Models\Department::where('company_id', $companyId)->where('is_active', 1)
            ->get()
            ->pluck('name', 'id')
            ->toArray();
    }
}

if (!function_exists('section_options')) {
    function section_options() {
        $companyId = get_user_data()->company_id;
        if (!$companyId) {
            return [];
        }
        return \App\Models\Section::where('company_id', $companyId)->where('is_active', 1)
            ->get()
            ->pluck('name', 'id')
            ->toArray();
    }
}

if (!function_exists('working_status_options')) {
    function working_status_options() {
        return \App\Enums\Employee\WorkingStatus::labels();
    }
}
if (!function_exists('insurance_status_options')) {
    function insurance_status_options()
    {
        return [
            1 => 'مؤمن عليه',
            0 => 'غير مؤمن عليه',
        ];
    }
}

if (!function_exists('is_employee_insured')) {
    function is_employee_insured($employeeId)
    {
        return \App\Models\EmployeeInsurance::where('employee_id', $employeeId)
            ->where('is_insured', 1)
            ->exists();
    }
}

if (!function_exists('job_category_options')) {
    function job_category_options() {
        $companyId = get_user_data()->company_id;
        if (!$companyId) {
            return [];
        }
        return \App\Models\JobCategory::where('company_id', $companyId)
            ->where('is_active', 1)
            ->get()
            ->pluck('name', 'id')
            ->toArray();
    }
}

if (!function_exists('level_options')) {
    function level_options() {
        $companyId = get_user_data()->company_id;

        if (!$companyId) {
            return [];
        }

        return \App\Models\Level::where('company_id', $companyId)
            ->where('is_active', 1)
            ->get()
            ->pluck('name', 'id')
            ->toArray();
    }
}

if (!function_exists('tax_status_options')) {
    function tax_status_options()
    {
        return [
            1 => 'يخضع للضريبة',
            0 => 'لا يخضع للضريبة',
        ];
    }
}

if (!function_exists('branch_options')) {
    function branch_options() {
        $companyId = get_user_data()->company_id;
        if (!$companyId) {
            return [];
        }
        return \App\Models\Branch::where('company_id', $companyId)
            ->where('is_active', 1)
            ->get()
            ->pluck('name', 'id')
            ->toArray();
    }
}

if (!function_exists('military_status_options')) {
    function military_status_options()
    {
        $options = [];
        foreach (\App\Enums\Employee\MilitaryStatus::cases() as $case) {
            $options[$case->value] = $case->label();
        }
        return $options;
    }
}
