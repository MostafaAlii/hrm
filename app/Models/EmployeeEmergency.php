<?php
namespace App\Models;
class EmployeeEmergency extends BaseModel {
    protected $table = "employee_emergencies";
    protected $fillable = [
        'uuid',
        'name_ar',
        'name_en',
        'relative_degree_id',
        'phone',
        'mobile',
        'email',
        'address',
        'employee_id',
        'company_id',
        'added_by_id',
        'updated_by_id',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function relativeDegree()
    {
        return $this->belongsTo(RelativeDegree::class);
    }
}
