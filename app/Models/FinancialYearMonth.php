<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\{BelongsTo};
class FinancialYearMonth extends Model {
    use HasFactory;
    protected $table = 'financial_year_months';
    protected $fillable = [
        'name',
        'number_of_days',
        'year_and_month',
        'start_date',
        'end_date',
        'fingerprint_start_date',
        'fingerprint_end_date',
        'is_closed',
        'financial_year_id',
        'company_id',
        'added_by_id',
        'updated_by_id',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'fingerprint_start_date' => 'date',
        'fingerprint_end_date' => 'date',
        'is_closed' => 'boolean',
    ];

    public function financialYear(): BelongsTo {
        return $this->belongsTo(FinancialYear::class, 'financial_year_id');
    }

    public function getIsClosedLabelAttribute(): string
    {
        return $this->is_closed
            ? trans('dashboard/general.closed')
            : trans('dashboard/general.open');
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