<?php
namespace App\Models;
class TaxSetting extends BaseModel {
    protected $table = 'tax_settings';
    protected $fillable = [
        'uuid',
        'recalculate_taxes',
        'tax_exemption_limit',
        'company_id',
        'added_by_id',
        'updated_by_id'
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

    public function taxBrackets()
    {
        return $this->hasMany(TaxBracket::class);
    }
}
