<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Relations\{BelongsTo};
class Governorate extends BaseModel {
    protected $table = 'governorates';
    protected $fillable = [
        'name_ar',
        'name_en',
        'is_active',
        'company_id',
        'uuid',
        'added_by_id',
        'updated_by_id',
        'transportation_allowance'
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

    public function scopeActive($query)
    {
        return $query->where('company_id', get_user_data()->company_id)->where('is_active', true);
    }
}