<?php
namespace App\Models;
class EmployeeExperience extends BaseModel {
    protected $fillable = [
        'uuid',
        'experience',
        'from_date',
        'to_date',
        'previous_work_phone',
        'previous_work_address',
        'notes',
        'employee_id',
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

    public function getExperienceDurationAttribute() {
        $from = $this->from_date;
        $to = $this->to_date;

        if ($from && $to) {
            $diff = $from->diff($to);
            return $diff->y . ' سنة ' . $diff->m . ' شهر';
        }

        return '-';
    }
}
