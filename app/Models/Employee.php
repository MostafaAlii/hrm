<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Concerns\HasUuid;
use App\Enums\Employee\WorkingStatus;
use App\Models\Concerns\UploadMedia;
class Employee extends Authenticatable {
    use HasUuid, HasApiTokens, HasFactory, Notifiable, UploadMedia;
    protected $table = 'employees';
    protected $fillable = [
        'code',
        'barcode',
        'name_ar',
        'name_en',
        'email',
        'password',
        'hiring_date',
        'birthday_date',
        'identity_number',
        'gender_id',
        'nationality_id',
        'level_id',
        'branch_id',
        'department_id',
        'section_id',
        'job_category_id',
        'salary_place_id',
        'is_active',
        'company_id',
        'uuid',
        'added_by_id',
        'updated_by_id',
        'working_status'
    ];
    protected $hidden = [
        'password',
        'remember_token',
    ];
    protected $casts = [
        'hiring_date' => 'date:Y-m-d',
        'birthday_date' => 'date:Y-m-d',
        'is_active' => 'boolean',
        'password' => 'hashed',
        'working_status' => WorkingStatus::class,
    ];

    public function getIsActiveLabelAttribute(): string
    {
        return $this->is_active
            ? trans('dashboard/general.active')
            : trans('dashboard/general.in_active');
    }

    public function gender()
    {
        return $this->belongsTo(Gender::class, 'gender_id');
    }

    public function nationality()
    {
        return $this->belongsTo(Nationality::class, 'nationality_id');
    }

    public function level()
    {
        return $this->belongsTo(Level::class, 'level_id');
    }

    public function governorate()
    {
        return $this->belongsTo(Governorate::class, 'governorate_id');
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class, 'branch_id');
    }

    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }

    public function section()
    {
        return $this->belongsTo(Section::class, 'section_id');
    }

    public function jobCategory()
    {
        return $this->belongsTo(JobCategory::class, 'job_category_id');
    }

    public function salaryPlace()
    {
        return $this->belongsTo(SalaryPlace::class, 'salary_place_id');
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

    public function scopeActive($query)
    {
        return $query->where('company_id', get_user_data()->company_id)->where('is_active', true);
    }

    public function profile()
    {
        return $this->hasOne(EmployeeProfile::class);
    }

    public function militaryService()
    {
        return $this->hasOne(MilitaryService::class);
    }

    public function media()
    {
        return $this->morphMany(Media::class, 'mediable');
    }
}
