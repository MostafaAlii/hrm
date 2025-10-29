<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Concerns\HasUuid;
use App\Enums\Employee\WorkingStatus;
use App\Models\Concerns\UploadMedia;
use App\Helpers\{TaxHelper,InsuranceHelper};
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
        'shift_type_id',
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

    public function getWorkingStatusLabelAttribute()
    {
        return WorkingStatus::labels()[$this->working_status->value] ?? '-';
    }

    public function gender()
    {
        return $this->belongsTo(Gender::class, 'gender_id');
    }

    public function shift()
    {
        return $this->belongsTo(ShiftType::class, 'shift_type_id');
    }

    public function getShiftTypeAttribute()
    {
        if ($this->shift && $this->shift->type) {
            return \App\Enums\ShiftType\ShiftType::label($this->shift->type);
        }
        return null;
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

    public function families()
    {
        return $this->hasMany(EmployeeFamily::class);
    }

    public function emergencyContacts()
    {
        return $this->hasMany(EmployeeEmergency::class);
    }

    public function trainings()
    {
        return $this->hasMany(EmployeeTraining::class);
    }

    public function licenses()
    {
        return $this->hasMany(EmployeeLicense::class);
    }

    public function employmentDocuments()
    {
        return $this->hasMany(EmployeeEmploymentDocument::class);
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

    public function contracts()
    {
        return $this->hasMany(EmployeeContract::class);
    }

    public function contractTypes()
    {
        return $this->hasMany(ContractType::class, 'company_id', 'company_id');
    }

    public function latestContract() {
        return $this->hasOne(EmployeeContract::class)->latestOfMany();
    }

    public function insurances()
    {
        return $this->hasMany(EmployeeInsurance::class);
    }

    public function latestInsurance() {
        return $this->hasOne(EmployeeInsurance::class)->latestOfMany();
    }

    public function vacationRequests()
    {
        return $this->hasMany(EmployeeVacationRequest::class, 'employee_id');
    }

    public function qualifications()
    {
        return $this->hasMany(EmployeeQualification::class, 'employee_id');
    }

    public function experiences()
    {
        return $this->hasMany(EmployeeExperience::class);
    }

    public function benefits()
    {
        return $this->hasMany(EmployeeBenefit::class);
    }

    public function salaryBasics()
    {
        return $this->hasMany(EmployeeSalaryBasic::class);
    }

    public function allowances()
    {
        return $this->hasMany(EmployeeAllowance::class);
    }

    public function entitlements()
    {
        return $this->hasMany(EmployeeEntitlement::class);
    }

    public function deductions()
    {
        return $this->hasMany(EmployeeDeduction::class);
    }

    // التامين الصحى الشامل
    public function variableInsurances()
    {
        return $this->hasMany(EmployeeVariableInsurance::class);
    }

    // التامين الاجتماعى
    public function socialInsurances()
    {
        return $this->hasMany(EmployeeSocialInsurance::class);
    }

    public function getTotalBasicSalaryAttribute()
    {
        return $this->salaryBasics()->sum('basic_salary');
    }

    public function getTotalVariableInsuranceAttribute()
    {
        return $this->variableInsurances()->sum('value');
    }

    public function getTotalDeductionsAttribute()
    {
        return $this->deductions()->sum('amount');
    }


    public function getTotalAllowancesAttribute()
    {
        return $this->allowances()->sum('amount');
    }

    public function getEntitlementsSumAttribute()
    {
        return $this->entitlements->sum('amount');
    }

    public function getTotalSalaryAttribute()
    {
        $basic = $this->total_basic_salary ?? 0;
        $allowances = $this->total_allowances ?? 0;
        $entitlements = $this->entitlements_sum ?? 0;
        return $basic + $allowances + $entitlements;
    }

    public function getMonthlyTaxAttribute() {
        $basicSalary = $this->total_basic_salary ?? 0;
        $companyId = $this->company_id ?? null;
        $taxData = TaxHelper::calculateMonthlyTax($basicSalary, $companyId);
        return $taxData['tax_amount'];
    }

    public function getNetSalaryAfterTaxAttribute() {
        $basicSalary = $this->total_basic_salary ?? 0;
        $companyId = $this->company_id ?? null;
        $taxData = TaxHelper::calculateMonthlyTax($basicSalary, $companyId);
        return $taxData['net_salary'];
    }

    /**
     * 🧾 إجمالي التأمين الاجتماعي
     */
    public function getSocialInsuranceAttribute(): float
    {
        if (!InsuranceHelper::isEmployeeInsured($this->id)) {
            return 0.0;
        }
        return InsuranceHelper::calculateSocialInsurance($this->id);
    }

    /**
     * 🏥 إجمالي التأمين الصحي الشامل
     */
    public function getComprehensiveInsuranceAttribute(): float
    {
        if (!InsuranceHelper::isEmployeeInsured($this->id)) {
            return 0.0;
        }
        return InsuranceHelper::calculateComprehensiveHealthInsurance($this->id);
    }

    /**
     * 💰 الإجمالي الكامل للتأمينات (الاجتماعي + الصحي)
     */
    public function getTotalInsuranceAttribute(): float
    {
        if (!InsuranceHelper::isEmployeeInsured($this->id)) {
            return 0.0;
        }
        return $this->social_insurance + $this->comprehensive_insurance;
    }

    public function media()
    {
        return $this->morphMany(Media::class, 'mediable');
    }
}
