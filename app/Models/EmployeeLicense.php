<?php
namespace App\Models;
class EmployeeLicense extends BaseModel {
    protected $table = "employee_licenses";
    protected $fillable = [
        'uuid',
        'license_variable_id',
        'license_number',
        'issue_date',
        'expiry_date',
        'issuing_authority',
        'notes',
        'employee_id',
        'company_id',
        'added_by_id',
        'updated_by_id'
    ];

    protected $casts = [
        'issue_date' => 'date',
        'expiry_date' => 'date',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function licenseVariable()
    {
        return $this->belongsTo(LicenseVariable::class);
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
