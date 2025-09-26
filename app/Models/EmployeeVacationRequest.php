<?php
namespace App\Models;
class EmployeeVacationRequest extends BaseModel {
    protected $table = 'employee_vacation_requests';
    protected $fillable = [
        'company_id',
        'added_by_id',
        'updated_by_id',
        'uuid',
        'employee_id',
        'vacation_id',
        'start_date',
        'end_date',
        'description',
        'notes',
        'status',
        'approved_by_id',
        'request_type',
        'duration_value',
        'duration_unit',
    ];
    protected $casts = [
        'start_date' => 'date:Y-m-d',
        'end_date'   => 'date:Y-m-d',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function vacation()
    {
        return $this->belongsTo(Vacation::class);
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

    public function approvedBy()
    {
        return $this->belongsTo(Admin::class, 'approved_by_id');
    }

    public function getFormattedDurationAttribute()
    {
        if ($this->duration_value && $this->duration_unit) {
            return "{$this->duration_value} " . match ($this->duration_unit) {
                'days'    => 'يوم',
                'hours'   => 'ساعة',
                'minutes' => 'دقيقة',
                default   => '',
            };
        }
        return null;
    }

    public function getRequestTypeLabelAttribute()
    {
        return match ($this->request_type) {
            'vacation'  => 'إجازة',
            'permission' => 'تصريح',
            default     => 'غير معروف',
        };
    }

    public function getStatusLabelAttribute()
    {
        return match ($this->status) {
            'pending'  => 'قيد الانتظار',
            'approved' => 'تمت الموافقة',
            'rejected' => 'تم الرفض',
        };
    }
}
