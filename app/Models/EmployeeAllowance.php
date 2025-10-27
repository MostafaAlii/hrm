<?php
namespace App\Models;
class EmployeeAllowance extends BaseModel {
    protected $table = "employee_allowances"; // جدول علاوات الموظف
    protected $fillable = [
        'uuid',
        'employee_id',
        'company_id',
        'added_by_id',
        'updated_by_id',
        'allowance_variable_id',
        'amount',
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

    public function allowanceVariable() {
        return $this->belongsTo(AllowanceVariable::class);
    }

}
