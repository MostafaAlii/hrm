<?php
namespace App\Models;
class EmployeeTraining extends BaseModel {
    protected $table = "employee_trainings";
    protected $fillable = [
        'name',
        'uuid',
        'training_place',
        'from_date',
        'to_date',
        'hours',
        'notes',
        'employee_id',
        'grade_id',
        'company_id',
        'added_by_id',
        'updated_by_id'
    ];

    protected $casts = [
        'from_date' => 'date',
        'to_date' => 'date',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
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
