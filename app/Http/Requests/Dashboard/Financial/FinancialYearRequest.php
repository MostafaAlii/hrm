<?php

namespace App\Http\Requests\Dashboard\Financial;

use Illuminate\Foundation\Http\FormRequest;

class FinancialYearRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array {
        $financialYearId = $this->route('financialYear')?->id
            ?? $this->route('financialYear')
            ?? 'null';
        return [
            'name' => [
                'required',
                'string',
                'max:255',
                //'unique:financial_years,name,' . ($this->route('id') ?? 'null') . ',id,company_id,' . (get_user_data()?->company_id ?? 'null'),
                'unique:financial_years,name,'
                    . $financialYearId
                    . ',id,company_id,' . (get_user_data()?->company_id ?? 'null'),
            ],
            'start_date' => ['required', 'date'],
            'end_date'   => ['required', 'date', 'after_or_equal:start_date'],
            'is_active'  => ['required', 'boolean'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => trans('validation.required', ['attribute' => trans('dashboard/financial_year.name')]),
            'name.unique'   => trans('validation.unique', ['attribute' => trans('dashboard/financial_year.name')]),
            'start_date.required' => trans('validation.required', ['attribute' => trans('dashboard/financial_year.start_date')]),
            'end_date.after_or_equal' => trans('validation.after_or_equal', ['attribute' => trans('dashboard/financial_year.end_date'), 'date' => trans('dashboard/financial_year.start_date')]),
        ];
    }
}