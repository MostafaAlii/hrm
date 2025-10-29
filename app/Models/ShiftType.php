<?php
namespace App\Models;
use App\Enums\ShiftType\ShiftType as ShiftTypeEnum;
use Illuminate\Database\Eloquent\Casts\Attribute;
use App\Casts\TimeCast;
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
        'from_time' => TimeCast::class,
        'to_time'   => TimeCast::class,
        'total_hour' => TimeCast::class,
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

    public function getFromTimeFormattedAttribute()
    {
        if (!$this->from_time) {
            return null;
        }
        $formatted = $this->from_time->format('h:i A');

        return str_replace(
            ['AM', 'PM'],
            [__('dashboard/shift_types.am'), __('dashboard/shift_types.pm')],
            $formatted
        );
    }

    public function getToTimeFormattedAttribute()
    {
        if (!$this->to_time) {
            return null;
        }

        $formatted = $this->to_time->format('h:i A');

        return str_replace(
            ['AM', 'PM'],
            [__('dashboard/shift_types.am'), __('dashboard/shift_types.pm')],
            $formatted
        );
    }

    public function getTotalHourFormattedAttribute()
    {
        if (!$this->total_hour) {
            return null;
        }

        $hours = $this->total_hour->format('H');
        $minutes = $this->total_hour->format('i');

        return (int)$hours . ' ' . __('dashboard/shift_types.hour') . ' ' . (int)$minutes . ' ' . __('dashboard/shift_types.minute');
    }

    public function scopeActive($query)
    {
        return $query->where('company_id', get_user_data()->company_id)->where('is_active', true);
    }
}
