<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Relations\{BelongsTo};
class PenaltyType extends BaseModel {
    protected $table = 'penalty_types';
    protected $fillable = [
        'uuid',
        'name_ar',
        'name_en',
        'type',
        'affects_salary',
        'calculation_type',
        'first_time',
        'first_time_description',
        'second_time',
        'second_time_description',
        'third_time',
        'third_time_description',
        'fourth_time',
        'fourth_time_description',
        'more_than_four_times',
        'more_than_four_times_description',
        'company_id',
        'uuid',
        'added_by_id',
        'updated_by_id',
    ];

    protected $casts = [
        'type' => \App\Enums\Penalty\PenaltyType::class,
        'calculation_type' => \App\Enums\Penalty\CalculationType::class,
        'affects_salary' => 'boolean',
        'first_time' => 'decimal:2',
        'second_time' => 'decimal:2',
        'third_time' => 'decimal:2',
        'fourth_time' => 'decimal:2',
        'more_than_four_times' => 'decimal:2',
    ];

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
}
