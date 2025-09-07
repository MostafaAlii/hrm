<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class MainSettingRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            // دقائق احتساب تأخير الحضور والانصراف المبكر
            'after_minutes_calculate_delay' => ['required', 'integer', 'min:1'],
            'after_minutes_calculate_early_departure' => ['required', 'integer', 'min:1'],
            'after_minutes_calculate_quarter_day' => ['required', 'integer', 'min:1'],
            'after_time_half_daycut' => ['required', 'integer', 'min:1'],
            'after_time_full_daycut' => ['required', 'integer', 'min:1'],

            // رصيد الاجازات
            'mounthly_vacation_balance' => ['required', 'integer', 'min:1', 'max:30'],
            'after_days_begin_vacation' => ['required', 'integer', 'min:1'],
            'first_balance_begin_vacation' => ['required', 'integer', 'min:1', 'max:30'],

            // قيم الخصم للغياب
            'sanction_value_first_absence' => ['required', 'integer', 'min:1'],
            'sanction_value_second_absence' => ['required', 'integer', 'min:1'],
            'sanction_value_third_absence' => ['required', 'integer', 'min:1'],
            'sanction_value_fourth_absence' => ['required', 'integer', 'min:1'],
        ];
    }

    public function messages(): array
    {
        return [
            '*.required' => 'هذا الحقل مطلوب',
            '*.integer'  => 'القيمة يجب أن تكون رقم صحيح',
            '*.min'      => 'القيمة يجب أن تكون أكبر من صفر',
            'mounthly_vacation_balance.max' => 'الرصيد الشهرى لا يمكن أن يزيد عن 30 يوم',
            'first_balance_begin_vacation.max' => 'الرصيد الاجازات الاولى لا يمكن أن يزيد عن 30 يوم',
        ];
    }
}
