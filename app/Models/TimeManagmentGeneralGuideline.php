<?php
namespace App\Models;
class TimeManagmentGeneralguideline extends BaseModel {
    protected $table = "time_managment_general_guidelines"; // القواعد العامه لاداره الوقت
    protected $fillable = [
        'uuid',
        'starts_week',
        'starts_month',
        'starts_working_days',
        'starts_year',

        'extended_shift_day1',
        'extended_shift_day2',

        'overtime_ignore',
        'overtime_overtime',
        'overtime_review',

        'exit_ignore',
        'exit_mission',
        'exit_departure',
        'exit_review',

        'shift_max_duration_minutes',
        'shift_min_duration_minutes',
        'shift_min_break_minutes',

        'attendance_symbol',
        'attendance_color',
        'attendance_holiday_color',
        'attendance_weekly_color',

        'company_id',
        'added_by_id',
        'updated_by_id',
    ];

    protected $casts = [
        'extended_shift_day1' => 'boolean',
        'extended_shift_day2' => 'boolean',

        'overtime_ignore'   => 'boolean',
        'overtime_overtime' => 'boolean',
        'overtime_review'   => 'boolean',

        'exit_ignore'     => 'boolean',
        'exit_mission'    => 'boolean',
        'exit_departure'  => 'boolean',
        'exit_review'     => 'boolean',
    ];

    public const WEEK_DAYS = [
        'saturday'  => 'السبت',
        'sunday'    => 'الأحد',
        'monday'    => 'الاثنين',
        'tuesday'   => 'الثلاثاء',
        'wednesday' => 'الأربعاء',
        'thursday'  => 'الخميس',
        'friday'    => 'الجمعة',
    ];

    public function getStartsWeekNameAttribute() {
        $days = [
            'saturday'  => 'السبت',
            'sunday'    => 'الأحد',
            'monday'    => 'الاثنين',
            'tuesday'   => 'الثلاثاء',
            'wednesday' => 'الأربعاء',
            'thursday'  => 'الخميس',
            'friday'    => 'الجمعة',
        ];

        return $days[$this->starts_week] ?? '';
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
