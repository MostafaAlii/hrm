<?php
namespace App\Models;
class AllowanceCategory extends BaseModel {
    protected $fillable = [
        'uuid',
        'code',
        'name_ar',
        'name_en',
        'is_active',
        'company_id',
        'added_by_id',
        'updated_by_id'
    ];

    protected $casts = [
        'is_active' => 'boolean',
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

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function getNameAttribute()
    {
        return app()->getLocale() === 'ar' ? $this->name_ar : ($this->name_en ?? $this->name_ar);
    }
}
