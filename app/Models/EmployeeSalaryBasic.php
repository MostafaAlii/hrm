<?php
namespace App\Models;
class EmployeeSalaryBasic extends BaseModel {
    protected $table = "employee_salary_basics"; // اساسى المرتب بتاع الموظف
    protected $fillable = [
        'uuid',
        'employee_id',
        'company_id',
        'added_by_id',
        'updated_by_id',
        'allowance_variable_id',
        'basic_salary',
        'is_taxable',
        'include_tax_in_salary',
        'has_min_limit',
        'min_limit_value',
        'has_max_limit',
        'max_limit_value'
    ];

    public function employee() {
        return $this->belongsTo(Employee::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function addedBy()
    {
        return $this->belongsTo(Admin::class, 'added_by_id');
    }

    public function updatedBy()
    {
        return $this->belongsTo(Admin::class, 'updated_by_id');
    }
}
