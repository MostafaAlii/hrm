<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\{BelongsTo};

class Branch extends BaseModel
{
    protected $table = 'branches';
    protected $fillable = [
        'name',
        'address',
        'phone',
        'is_active',
        'company_id',
        'uuid',
        'added_by_id',
        'updated_by_id'
    ];
    public function getIsActiveLabelAttribute(): string
    {
        return $this->is_active
            ? trans('dashboard/general.active')
            : trans('dashboard/general.in_active');
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function addedBy(): BelongsTo
    {
        return $this->belongsTo(Admin::class, 'added_by_id');
    }

    public function updatedBy(): BelongsTo
    {
        return $this->belongsTo(Admin::class, 'updated_by_id');
    }

    public function departments()
    {
        return $this->hasMany(Department::class, 'branch_id');
    }

    public function scopeActive($query)
    {
        return $query->where('company_id', get_user_data()->company_id)->where('is_active', true);
    }
}