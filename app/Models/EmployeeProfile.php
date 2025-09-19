<?php

namespace App\Models;

use App\Enums\Employee\MaritalStatus;
class EmployeeProfile extends BaseModel
{
    protected $table = 'employee_profiles';
    protected $fillable = [
        'employee_id',
        'identity_number',
        'birthday_date',
        'gender_id',
        'birth_governorate_id',
        'nationality_id',
        'religion_id',
        'marital_status',
        'blood_type_id',
        'address_governorate_id',
        'address_city_id',
        'address_city',
        'address',
        'phone',
        'mobile1',
        'mobile2',
        'fax',
        'email',
    ];

    protected $casts = [
        'marital_status' => MaritalStatus::class,
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function gender()
    {
        return $this->belongsTo(Gender::class);
    }

    public function birthGovernorate()
    {
        return $this->belongsTo(Governorate::class, 'birth_governorate_id');
    }

    public function nationality()
    {
        return $this->belongsTo(Nationality::class);
    }

    public function religion()
    {
        return $this->belongsTo(Religion::class);
    }

    public function bloodType()
    {
        return $this->belongsTo(BloodType::class);
    }

    public function addressGovernorate()
    {
        return $this->belongsTo(Governorate::class, 'address_governorate_id');
    }

    public function addressCity()
    {
        return $this->belongsTo(City::class, 'address_city_id');
    }
}
