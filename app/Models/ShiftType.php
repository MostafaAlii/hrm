<?php
namespace App\Models;
use App\Enums\ShiftType\ShiftType as ShiftTypeEnum;
use Illuminate\Database\Eloquent\Casts\Attribute;
class ShiftType extends BaseModel {
    protected $fillable = [
        'uuid',
        'type',
        'from_time',
        'to_time',
        'total_hour',
        'is_active',
        'company_id',
        'added_by_id',
        'updated_by_id',
    ];
    protected $casts = [
        'is_active' => 'boolean',
        'from_time' => 'datetime:H:i',
        'to_time'   => 'datetime:H:i',
        'total_hour' => 'datetime:H:i',
        'type'      => ShiftTypeEnum::class,
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

    public function getIsActiveLabelAttribute(): string
    {
        return $this->is_active
            ? trans('dashboard/general.active')
            : trans('dashboard/general.in_active');
    }
    
    public function getTypeLabelAttribute(): string
    {
        return ShiftTypeEnum::label($this->type);
    }

    public function getTypeBadgeAttribute(): string
    {
        return ShiftTypeEnum::badge($this->type);
    }
}