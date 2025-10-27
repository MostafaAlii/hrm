<?php

namespace App\Models;
class EmployeeEntitlement extends BaseModel {
    protected $table = "employee_entitlements"; // جدول استحقاقات الموظف
    protected $fillable = [
        'uuid',
        'employee_id',
        'company_id',
        'added_by_id',
        'updated_by_id',
        'entitlement_variable_id',
        'amount',
    ];

    public function entitlementVariable()
    {
        return $this->belongsTo(EntitlementVariable::class);
    }

    public function employee()
    {
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
