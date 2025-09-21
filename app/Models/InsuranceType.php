<?php
namespace App\Models;
class InsuranceType extends BaseModel {
    protected $table = "insurance_types";
    protected $fillable = [
        'name_ar',
        'name_en',
        'code',
        'company_id',
        'uuid',
        'added_by_id',
        'updated_by_id',
        'employee_percentage',
        'company_percentage',
    ];

    protected $casts = [
        'employee_percentage'  => 'decimal:2',
        'company_percentage'   => 'decimal:2',
    ];

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
