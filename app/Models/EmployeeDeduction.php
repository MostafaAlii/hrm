<?php
namespace App\Models;
class EmployeeDeduction extends BaseModel {
    protected $table = "employee_deductions"; // جدول استقطاعات الموظف

    protected $fillable = [
        'uuid',
        'employee_id',
        'company_id',
        'added_by_id',
        'deduction_variable_id',
        'amount',
    ];

    public function variable()
    {
        return $this->belongsTo(DeductionVariable::class, 'deduction_variable_id');
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
