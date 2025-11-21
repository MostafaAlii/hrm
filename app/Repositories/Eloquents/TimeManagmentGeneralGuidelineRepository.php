<?php

namespace App\Repositories\Eloquents;
use Illuminate\Http\Request;
use App\Models\TimeManagmentGeneralguideline;
use App\Repositories\Contracts\TimeManagmentGeneralGuidelineRepositoryInterface;
class TimeManagmentGeneralGuidelineRepository extends BaseRepository implements TimeManagmentGeneralGuidelineRepositoryInterface {
    protected $rules = [
        'starts_week'                => 'required|in:saturday,sunday,monday,tuesday,wednesday,thursday,friday',
        'starts_month'               => 'required|integer|min:1|max:31',
        'starts_working_days'        => 'required|integer|min:1|max:31',
        'starts_year'                => 'required|integer|min:1|max:2100',

        'extended_shift_day1'        => 'nullable|boolean',
        'extended_shift_day2'        => 'nullable|boolean',

        'overtime_ignore'            => 'nullable|boolean',
        'overtime_overtime'          => 'nullable|boolean',
        'overtime_review'            => 'nullable|boolean',

        'exit_ignore'                => 'nullable|boolean',
        'exit_mission'               => 'nullable|boolean',
        'exit_departure'             => 'nullable|boolean',
        'exit_review'                => 'nullable|boolean',

        'shift_max_duration_minutes' => 'nullable|integer|min:1',
        'shift_min_duration_minutes' => 'nullable|integer|min:1',
        'shift_min_break_minutes'    => 'nullable|integer|min:1',

        'attendance_symbol'          => 'nullable|string|max:50',
        'attendance_color'           => 'nullable|string|max:20',
        'attendance_holiday_color'   => 'nullable|string|max:20',
        'attendance_weekly_color'    => 'nullable|string|max:20',
    ];

    public function __construct(TimeManagmentGeneralguideline $model)
    {
        parent::__construct($model);
    }

    protected function extraStoreFields(Request $request): array {
        return [
            'starts_week'         => $request->starts_week,
            'starts_month'        => $request->starts_month,
            'starts_working_days' => $request->starts_working_days,
            'starts_year'         => $request->starts_year,
            'extended_shift_day1' => $request->boolean('extended_shift_day1'),
            'extended_shift_day2' => $request->boolean('extended_shift_day2'),
            'overtime_ignore'     => $request->boolean('overtime_ignore'),
            'overtime_overtime'   => $request->boolean('overtime_overtime'),
            'overtime_review'     => $request->boolean('overtime_review'),

            'exit_ignore'         => $request->boolean('exit_ignore'),
            'exit_mission'        => $request->boolean('exit_mission'),
            'exit_departure'      => $request->boolean('exit_departure'),
            'exit_review'         => $request->boolean('exit_review'),

            'shift_max_duration_minutes' => $request->shift_max_duration_minutes,
            'shift_min_duration_minutes' => $request->shift_min_duration_minutes,
            'shift_min_break_minutes'    => $request->shift_min_break_minutes,

            'attendance_symbol'        => $request->attendance_symbol,
            'attendance_color'         => $request->attendance_color,
            'attendance_holiday_color' => $request->attendance_holiday_color,
            'attendance_weekly_color'  => $request->attendance_weekly_color,
        ];
    }

    protected function extraUpdateFields(Request $request, $id): array
    {
        return $this->extraStoreFields($request);
    }
}
