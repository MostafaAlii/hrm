<?php
namespace App\Models;
class JobCategory extends BaseModel {
    protected $table = "job_categories";
    protected $fillable = [
        'uuid',
        'name',
        'is_active',
        'company_id',
        'section_id',
        'department_id',
        'added_by_id',
        'updated_by_id',
    ];

    public function getIsActiveLabelAttribute(): string
    {
        return $this->is_active
            ? trans('dashboard/general.active')
            : trans('dashboard/general.in_active');
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

    public function section()
    {
        return $this->belongsTo(Section::class, 'section_id');
    }

    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }
}