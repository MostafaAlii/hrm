<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Relations\{BelongsTo};
class PerformanceReportItem extends BaseModel {
    protected $table = 'performance_report_items';
    protected $fillable = [
        'name_ar',
        'name_en',
        'company_id',
        'uuid',
        'added_by_id',
        'updated_by_id',
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
