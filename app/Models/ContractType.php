<?php

namespace App\Models;
class ContractType extends BaseModel {
    protected $table = "contract_types";
    protected $fillable = [
        'name_ar',
        'name_en',
        'code',
        'company_id',
        'uuid',
        'added_by_id',
        'updated_by_id',
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