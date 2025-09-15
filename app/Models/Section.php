<?php
namespace App\Models;
class Section extends BaseModel {
    protected $table = "sections";
    protected $fillable = [
        'uuid',
        'name',
        'phone',
        'note',
        'is_active',
        'department_id',
        'company_id',
        'added_by_id',
        'updated_by_id',
    ];

    public function getIsActiveLabelAttribute(): string {
        return $this->is_active
            ? trans('dashboard/general.active')
            : trans('dashboard/general.in_active');
    }

    public function department() {
        return $this->belongsTo(Department::class);
    }

    public function company() {
        return $this->belongsTo(Company::class);
    }

    public function jobs() {
        return $this->hasMany(JobCategory::class, 'section_id');
    }

    public function addedBy() {
        return $this->belongsTo(Admin::class, 'added_by_id');
    }

    public function updatedBy() {
        return $this->belongsTo(Admin::class, 'updated_by_id');
    }
}