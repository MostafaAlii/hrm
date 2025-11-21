<?php

namespace App\Models;

class EmployeeLeaveAllocation extends BaseModel
{
    protected $table = "employee_leave_allocations"; //  تخصيص اجازات الموظف
    protected $fillable = [
        'uuid',
        'employee_id',
        'company_id',
        'added_by_id',
        'updated_by_id',
        'leave_variable_id',
        'company_id',
        'allocated_balance',
        'previous_years_balance',
        'is_year',
        'is_break_year',
        'year',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function leaveVariable()
    {
        return $this->belongsTo(LeaveVariable::class);
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
