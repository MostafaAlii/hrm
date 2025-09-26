<?php
namespace App\Models;
class Vacation extends BaseModel {
    protected $table = 'vacations';
    protected $fillable = [
        'name_ar',
        'name_en',
        'code',
        'deduct_from_balance',
        'deduction_value',
        'balance',
        'color',
        'ten_years_balance',
        'fifty_years_balance',
        'can_be_carried_forward',
        'affects_ten_years',
        'affects_fifty_years',
        'affects_annual_leave',
        'company_id',
        'added_by_id',
        'updated_by_id',
    ];

    protected $casts = [
        'deduct_from_balance'   => 'boolean',
        'can_be_carried_forward'=> 'boolean',
        'affects_ten_years'     => 'boolean',
        'affects_fifty_years'   => 'boolean',
        'affects_annual_leave'  => 'boolean',
    ];

    public function getDeductFromBalanceLabelAttribute(): string {
        return $this->deduct_from_balance ? 'نعم' : 'لا';
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
