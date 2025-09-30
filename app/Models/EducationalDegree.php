<?php
namespace App\Models;
class EducationalDegree extends BaseModel {
    protected $table = "educational_degrees";
    protected $fillable = [
        'uuid',
        'name_ar',
        'name_en',
        'company_id',
        'added_by_id',
        'updated_by_id',
    ];

    public function company() {
        return $this->belongsTo(Company::class);
    }

    public function addedBy() {
        return $this->belongsTo(Admin::class, 'added_by_id');
    }

    public function updatedBy() {
        return $this->belongsTo(Admin::class, 'updated_by_id');
    }
}