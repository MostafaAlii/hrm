<?php
namespace App\Models;
class EmployeeBenefit extends BaseModel {
    protected $table = "employee_benefits";
    protected $fillable = [
        'benefit_variable_id',
        'benefit_date',
        'withdrawal_date',
        'withdrawal_reason',
        'notes',
        'employee_id',
        'company_id',
        'added_by_id',
        'updated_by_id'
    ];

    protected $casts = [
        'benefit_date' => 'date',
        'withdrawal_date' => 'date',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function benefitVariable()
    {
        return $this->belongsTo(BenefitVariable::class);
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

    public function getBenefitStatusAttribute()
    {
        return $this->withdrawal_date ? 'مسحوبة' : 'نشطة';
    }

    public function getBenefitStatusBadgeAttribute()
    {
        return $this->withdrawal_date
            ? '<span class="badge bg-danger">مسحوبة</span>'
            : '<span class="badge bg-success">نشطة</span>';
    }
}
