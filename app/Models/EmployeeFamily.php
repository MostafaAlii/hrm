<?php
namespace App\Models;
class EmployeeFamily extends BaseModel {
    protected $table = "employee_families";
    protected $fillable = [
        'uuid',
        'name_ar',
        'name_en',
        'gender',
        'is_working',
        'identity_number',
        'birth_date',
        'subject_to_health_insurance',
        'notes',
        'employee_id',
        'relative_degree_id',
        'family_job_id',
        'company_id',
        'added_by_id',
        'updated_by_id',
    ];

    public function employee() {
        return $this->belongsTo(Employee::class);
    }

    public function relativeDegree()
    {
        return $this->belongsTo(RelativeDegree::class, 'relative_degree_id');
    }

    public function familyJob()
    {
        return $this->belongsTo(FamilyJob::class, 'family_job_id');
    }


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
