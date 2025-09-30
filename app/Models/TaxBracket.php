<?php
namespace App\Models;
class TaxBracket extends BaseModel {
    protected $fillable = [
        'uuid',
        'bracket_name',
        'value',
        'percentage',
        'discount_percentage',
        'level',
        'tax_setting_id',
        'company_id',
        'added_by_id',
        'updated_by_id'
    ];

    protected $casts = [
        'value' => 'decimal:2',
        'percentage' => 'decimal:2',
        'discount_percentage' => 'decimal:2',
        'level' => 'integer',
    ];

    public function taxSetting()
    {
        return $this->belongsTo(TaxSetting::class);
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

    public function getLevelTextAttribute()
    {
        return 'المستوى ' . $this->level;
    }

    // Accessor للنسبة المئوية
    public function getPercentageTextAttribute()
    {
        return $this->percentage . '%';
    }

    // Accessor لنسبة الخصم
    public function getDiscountPercentageTextAttribute()
    {
        return $this->discount_percentage . '%';
    }
}
