<?php

namespace App\Models;

class EmployeeQualification extends BaseModel {
    protected $table = "employee_qualifications";
    protected $fillable = [
        'uuid',
        'employee_id',
        'qualification_id',
        'educational_degree_id',
        'university_id',
        'specialization_id',
        'grade_id',
        'study_years',
        'graduation_year',
        'notes',
        'company_id',
        'added_by_id',
        'updated_by_id',
    ];
    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function qualification()
    {
        return $this->belongsTo(Qualification::class);
    }

    public function educationalDegree()
    {
        return $this->belongsTo(EducationalDegree::class);
    }
    public function university()
    {
        return $this->belongsTo(University::class);
    }

    public function specialization()
    {
        return $this->belongsTo(Specialization::class);
    }

    public function grade()
    {
        return $this->belongsTo(Grade::class);
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
}
