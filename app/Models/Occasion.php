<?php
namespace App\Models;
class Occasion extends BaseModel {
    protected $table = "occasions";
    protected $fillable = [
        'uuid',
        'name',
        'from_date',
        'to_date',
        'total_days',
        'is_active',
        'company_id',
        'added_by_id',
        'updated_by_id',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'from_date' => 'date',   
        'to_date'   => 'date',  
    ];

    public function getIsActiveLabelAttribute(): string
    {
        return $this->is_active
            ? trans('dashboard/general.active')
            : trans('dashboard/general.in_active');
    }

    public function getFromDateFormattedAttribute()
    {
        return $this->from_date?->translatedFormat('d F Y');
    }

    public function getToDateFormattedAttribute()
    {
        return $this->to_date?->translatedFormat('d F Y');
    }

    public function getTotalDaysAttribute()
    {
        return ($this->from_date && $this->to_date)
            ? $this->from_date->diffInDays($this->to_date) + 1
            : null;
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