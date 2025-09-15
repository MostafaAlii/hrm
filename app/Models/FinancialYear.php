<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Relations\{HasMany,BelongsTo};
class FinancialYear extends BaseModel {
    protected $table = 'financial_years';
    protected $fillable = [
        'name',
        'start_date',
        'end_date',
        'is_active',
        'company_id',
        'uuid',
        'added_by_id',
        'updated_by_id'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    public function getIsActiveLabelAttribute(): string {
        return $this->is_active
            ? trans('dashboard/general.active')
            : trans('dashboard/general.in_active');
    }

    public function getDisplayNameAttribute(): string {
        return $this->name . ' (' . $this->start_date->format('Y') . ')';
    }


    public function company(): BelongsTo {
        return $this->belongsTo(Company::class);
    }

    public function months(): HasMany {
        return $this->hasMany(FinancialYearMonth::class, 'financial_year_id');
    }

    public function addedBy(): BelongsTo
    {
        return $this->belongsTo(Admin::class, 'added_by_id');
    }

    public function updatedBy(): BelongsTo
    {
        return $this->belongsTo(Admin::class, 'updated_by_id');
    }
}