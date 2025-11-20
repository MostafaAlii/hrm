<?php
namespace App\Models;
class LeaveVariable extends BaseModel {
    protected $table = "leave_variables"; // متغيرات الاجازات
    protected $fillable = [
        'uuid',
        'name_ar',
        'name_en',
        'code',
        'symbol',
        'company_id',
        'added_by_id',
        'updated_by_id',
        'color',
        'deduct_from_balance',
        'can_transfer',
        'ten_years_insurance',
        'fifty_years',
        'affect_annual_leave',
        'deducted_value',
        'balance',
        'ten_years_balance',
        'fifty_years_balance',
    ];

    protected $casts = [
        'deduct_from_balance' => 'boolean',
        'can_transfer' => 'boolean',
        'ten_years_insurance' => 'boolean',
        'fifty_years' => 'boolean',
        'affect_annual_leave' => 'boolean',
        'deducted_value' => 'decimal:2',
        'balance' => 'decimal:2',
        'ten_years_balance' => 'decimal:2',
        'fifty_years_balance' => 'decimal:2',
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

    public function getDeductFromBalanceLabelAttribute() {
        if ($this->deduct_from_balance) {
            return '<span class="text-success">نعم <i class="fa fa-check"></i></span>';
        }
        return '<span class="text-danger">لا <i class="fa fa-times"></i></span>';
    }

}
