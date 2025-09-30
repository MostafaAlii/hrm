<?php
namespace App\Models;
class InsuranceSetting extends BaseModel {
    protected $table = 'insurance_settings';
    protected $fillable = [
        'uuid',
        'max_insurance_amount',
        'min_insurance_amount',
        'employee_deduction_percentage',
        'company_deduction_percentage',
        'employees_fund_percentage',
        'company_id',
        'added_by_id',
        'updated_by_id'
    ];

    protected $casts = [
        'max_insurance_amount' => 'decimal:2',
        'min_insurance_amount' => 'decimal:2',
        'employee_deduction_percentage' => 'decimal:2',
        'company_deduction_percentage' => 'decimal:2',
        'employees_fund_percentage' => 'decimal:2',
    ];

    public function getExistsAttribute() {
        return !is_null($this->id);
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

    public function getEmployeeDeductionPercentageTextAttribute()
    {
        return $this->employee_deduction_percentage . '%';
    }

    public function getCompanyDeductionPercentageTextAttribute()
    {
        return $this->company_deduction_percentage . '%';
    }

    public function getEmployeesFundPercentageTextAttribute()
    {
        return $this->employees_fund_percentage . '%';
    }
}
