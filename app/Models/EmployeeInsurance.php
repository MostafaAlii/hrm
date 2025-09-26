<?php
namespace App\Models;
class EmployeeInsurance extends BaseModel
{
    protected $fillable = [
        'uuid',
        'employee_id',
        'insurance_type_id',
        'insurance_region_id',
        'insurance_office_id',
        'insurance_number',
        'insurance_date',
        'salary_insurance',
        'employee_fund',
        'is_health_insured',
        'is_insured',
        'dependents_count',
        'non_dependents_count',
        'company_share',
        'employee_share',
        'insurance_amount',
        'company_id',
        'added_by_id',
        'updated_by_id',
    ];

    protected $casts = [
        'insurance_date' => 'date:Y-m-d',
    ];

    public function employee() {
        return $this->belongsTo(Employee::class);
    }
    public function insuranceType() {
        return $this->belongsTo(InsuranceType::class);
    }
    public function insuranceRegion() {
        return $this->belongsTo(InsuranceRegion::class);
    }
    public function insuranceOffice() {
        return $this->belongsTo(InsuranceOffice::class);
    }
}