<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeVariableInsurance extends BaseModel {
    protected $table = "employee_variable_insurances"; // جدول تامين صحى شامل الموظف
    protected $fillable = [
        'uuid',
        'employee_id',
        'company_id',
        'added_by_id',
        'updated_by_id',
        'type',
        'value',
    ];

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
