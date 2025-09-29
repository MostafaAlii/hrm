<?php
namespace App\Models;
class RelativeDegree extends BaseModel {
    protected $table = "relative_degrees";
    protected $fillable = [
        'name_ar',
        'name_en',
        'insurance_percentage',
        'company_id',
        'uuid',
        'added_by_id',
        'updated_by_id',
    ];
    protected $casts = [
        'insurance_percentage' => 'float',
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

    public function families()
    {
        return $this->hasMany(EmployeeFamily::class);
    }
}
