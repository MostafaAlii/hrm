<?php
namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Repositories\Contracts\TimeManagmentGeneralGuidelineRepositoryInterface;
use Illuminate\Http\Request;
class TimeManagmentGeneralGuidelineController extends Controller {
    protected $repo;
    public function __construct(TimeManagmentGeneralGuidelineRepositoryInterface $repo) {
        $this->repo = $repo;
    }

    public function index() {
        $company_id = get_user_data()->company_id ?? null;
        $record = \App\Models\TimeManagmentGeneralguideline::where('company_id', $company_id)->first();
        return view('dashboard.admin.time-managment.general-guidelines.index', [
            'title' => 'القواعد العامة لإدارة الوقت',
            'record' => $record
        ]);
    }

    public function create() {
        return $this->repo->create(
            'dashboard.time-managment.general-guidelines.create',
            'إضافة قاعدة جديدة'
        );
    }

    public function store(Request $request)
    {
        $company_id = get_user_data()->company_id ?? null;

        // تحويل الـ checkboxes للقيم الصحيحة
        $data = [
            'starts_week' => $request->input('start_week'),
            'starts_month' => $request->input('start_month'),
            'starts_year' => $request->input('start_year'),
            'starts_working_days' => $request->input('work_days_count'),

            'extended_shift_day1' => $request->has('extended_first_day'),
            'extended_shift_day2' => $request->has('extended_second_day'),

            'overtime_ignore' => $request->has('overtime_ignore'),
            'overtime_overtime' => $request->has('overtime_overtime'),
            'overtime_review' => $request->has('overtime_review'),

            'exit_ignore' => $request->has('exit_ignore'),
            'exit_mission' => $request->has('exit_mission'),
            'exit_departure' => $request->has('exit_departure'),
            'exit_review' => $request->has('exit_review'),

            'shift_max_duration_minutes' => $request->input('shift_max_duration_minutes'),
            'shift_min_duration_minutes' => $request->input('shift_min_duration_minutes'),
            'shift_min_break_minutes' => $request->input('shift_min_break_minutes'),

            'attendance_symbol' => $request->input('attendance_symbol'),
            'attendance_color' => $request->input('attendance_color'),
            'attendance_holiday_color' => $request->input('attendance_holiday_color'),
            'attendance_weekly_color' => $request->input('attendance_weekly_color'),

            'company_id' => $company_id,
            'added_by_id' => get_user_data()->id ?? null,
            'updated_by_id' => get_user_data()->id ?? null,
        ];

        // Update or create based on company_id
        $record = \App\Models\TimeManagmentGeneralguideline::updateOrCreate(
            ['company_id' => $company_id],
            $data
        );

        return redirect()->back()->with('success', 'تم الحفظ بنجاح!');
    }



    public function edit($id)
    {
        return $this->repo->edit(
            $id,
            'dashboard.time-managment.general-guidelines.edit',
            'تعديل القاعدة'
        );
    }

    public function update(Request $request, $id)
    {
        return $this->repo->update($request, $id);
    }

    public function destroy($id) {
        $model = $this->repo->find($id);
        return $this->repo->destroy($model);
    }
}
