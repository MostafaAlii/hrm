<?php

namespace App\Models;

class Nationality extends BaseModel
{
    protected $table = "nationalities";
    protected $fillable = [
        'uuid',
        'name',
        'is_active',
        'company_id',
        'added_by_id',
        'updated_by_id',
    ];

    public function getIsActiveLabelAttribute(): string
    {
        return $this->is_active
            ? trans('dashboard/general.active')
            : trans('dashboard/general.in_active');
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

    public function scopeActive($query)
    {
        return $query->where('company_id', get_user_data()->company_id)->where('is_active', true);
    }
}