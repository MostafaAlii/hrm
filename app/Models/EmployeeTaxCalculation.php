<?php
namespace App\Models;
class EmployeeTaxCalculation extends BaseModel {
    protected $table = "employee_tax_calculations"; // تفاصيل ضرائب الموظف
    protected $fillable = [
        'uuid',
        'employee_id',
        'company_id',
        'tax_setting_id',
        'monthly_salary',
        'annual_salary',
        'annual_taxable_income',
        'monthly_taxable_income',
        'annual_tax',
        'monthly_tax',
        'brackets_breakdown'
    ];

    protected $casts = [
        'brackets_breakdown' => 'array'
    ];
}