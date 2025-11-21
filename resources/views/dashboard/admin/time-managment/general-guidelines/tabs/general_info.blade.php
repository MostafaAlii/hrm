<!-- Start Form -->
<form action="{{ route('admin.time-managment.general-guideline.store') }}" method="POST">
    @csrf

    <div class="row">
        {{-- =================== Box 1: الورديات الممتدة =================== --}}
        <div class="col-md-4">
            <div class="p-3 mb-4 border rounded">
                <h5 class="mb-3">الورديات الممتدة</h5>

                <div class="mb-2 form-check">
                    <input class="form-check-input" type="checkbox" id="extended_first_day" name="extended_first_day" {{
                        old('extended_first_day', $record->extended_shift_day1 ?? false) ? 'checked' : '' }}>
                    <label class="form-check-label" for="extended_first_day">
                        تظهر في اليوم الأول
                    </label>
                </div>

                <div class="mb-2 form-check">
                    <input class="form-check-input" type="checkbox" id="extended_second_day" name="extended_second_day"
                        {{ old('extended_second_day', $record->extended_shift_day2 ?? false) ? 'checked' : '' }}>
                    <label class="form-check-label" for="extended_second_day">
                        تظهر في اليوم الثاني
                    </label>
                </div>
            </div>
        </div>

        {{-- =================== Box 2: البدايات =================== --}}
        <div class="col-md-8">
            <div class="p-3 mb-4 border rounded">
                <h5 class="mb-3">البدايات</h5>

                {{-- Dropdown: بداية الأسبوع --}}
                <div class="mb-3 col-md-6">
                    <label class="form-label">بداية الأسبوع</label>
                    <select name="start_week" class="form-select">
                        @foreach(\App\Models\TimeManagmentGeneralGuideline::WEEK_DAYS as $dayKey => $dayName)
                        <option value="{{ $dayKey }}" {{ old('start_week', $record->starts_week ?? '') == $dayKey ?
                            'selected' : '' }}>
                            {{ $dayName }}
                        </option>
                        @endforeach
                    </select>
                </div>

                <div class="row">
                    {{-- بداية الشهر --}}
                    <div class="mb-3 col-md-4">
                        <label class="form-label">بداية الشهر</label>
                        <input type="number" class="form-control" name="start_month" placeholder="مثال: 1"
                            value="{{ old('start_month', $record->starts_month ?? '') }}">
                    </div>

                    {{-- بداية العام --}}
                    <div class="mb-3 col-md-4">
                        <label class="form-label">بداية العام</label>
                        <input type="number" class="form-control" name="start_year" placeholder="مثال: 2025"
                            value="{{ old('start_year', $record->starts_year ?? '') }}">
                    </div>

                    {{-- عدد أيام العمل --}}
                    <div class="mb-3 col-md-4">
                        <label class="form-label">عدد أيام العمل</label>
                        <input type="number" class="form-control" name="work_days_count" placeholder="مثال: 6"
                            value="{{ old('work_days_count', $record->starts_working_days ?? '') }}">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        {{-- =================== Box 3: معالجة الوقت الإضافي =================== --}}
        <div class="col-md-4">
            <div class="p-3 mb-4 border rounded">
                <h5 class="mb-3">معالجة الوقت الإضافي</h5>
                <div class="row">
                    <div class="mb-2 form-check col-md-4">
                        <input class="form-check-input" type="checkbox" id="overtime_ignore" name="overtime_ignore" {{
                            old('overtime_ignore', $record->overtime_ignore ?? false) ? 'checked' : '' }}>
                        <label class="form-check-label" for="overtime_ignore">
                            تجاهلها
                        </label>
                    </div>

                    <div class="mb-2 form-check col-md-4">
                        <input class="form-check-input" type="checkbox" id="overtime_overtime" name="overtime_overtime"
                            {{ old('overtime_overtime', $record->overtime_overtime ?? false) ? 'checked' : '' }}>
                        <label class="form-check-label" for="overtime_overtime">
                            وقت إضافي
                        </label>
                    </div>

                    <div class="mb-2 form-check col-md-4">
                        <input class="form-check-input" type="checkbox" id="overtime_review" name="overtime_review" {{
                            old('overtime_review', $record->overtime_review ?? false) ? 'checked' : '' }}>
                        <label class="form-check-label" for="overtime_review">
                            مراجعة
                        </label>
                    </div>
                </div>
            </div>
        </div>

        {{-- =================== Box 4: معالجة الخروج =================== --}}
        <div class="col-md-8">
            <div class="p-3 mb-4 border rounded">
                <h5 class="mb-3">معالجة الخروج</h5>
                <div class="row">
                    <div class="mb-2 form-check col-md-3">
                        <input class="form-check-input" type="checkbox" id="exit_ignore" name="exit_ignore" {{
                            old('exit_ignore', $record->exit_ignore ?? false) ? 'checked' : '' }}>
                        <label class="form-check-label" for="exit_ignore">
                            تجاهلها
                        </label>
                    </div>

                    <div class="mb-2 form-check col-md-3">
                        <input class="form-check-input" type="checkbox" id="exit_review" name="exit_review" {{
                            old('exit_review', $record->exit_review ?? false) ? 'checked' : '' }}>
                        <label class="form-check-label" for="exit_review">
                            مراجعة
                        </label>
                    </div>

                    <div class="mb-2 form-check col-md-3">
                        <input class="form-check-input" type="checkbox" id="exit_departure" name="exit_departure" {{
                            old('exit_departure', $record->exit_departure ?? false) ? 'checked' : '' }}>
                        <label class="form-check-label" for="exit_departure">
                            انصراف
                        </label>
                    </div>

                    <div class="mb-2 form-check col-md-3">
                        <input class="form-check-input" type="checkbox" id="exit_mission" name="exit_mission" {{
                            old('exit_mission', $record->exit_mission ?? false) ? 'checked' : '' }}>
                        <label class="form-check-label" for="exit_mission">
                            خروج مأمورية
                        </label>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        {{-- =================== Box الورديات =================== --}}
        <div class="col-md-12">
            <div class="p-4 mb-4 border rounded">
                <h5 class="mb-4 text-center">الورديات</h5>

                <div class="row justify-content-center">
                    {{-- أطول فترة للوردية --}}
                    <div class="mb-3 col-md-3 d-flex align-items-center">
                        <label class="mb-0 form-label me-2">أطول فترة للوردية (دقيقة)</label>
                        <input type="number" class="form-control" name="shift_max_duration_minutes"
                            placeholder="مثال: 480"
                            value="{{ old('shift_max_duration_minutes', $record->shift_max_duration_minutes ?? '') }}">
                    </div>

                    {{-- أقصر فترة للوردية --}}
                    <div class="mb-3 col-md-3 d-flex align-items-center">
                        <label class="mb-0 form-label me-2">أقصر فترة للوردية (دقيقة)</label>
                        <input type="number" class="form-control" name="shift_min_duration_minutes"
                            placeholder="مثال: 60"
                            value="{{ old('shift_min_duration_minutes', $record->shift_min_duration_minutes ?? '') }}">
                    </div>

                    {{-- أقصر استراحة بين الورديات --}}
                    <div class="mb-3 col-md-3 d-flex align-items-center">
                        <label class="mb-0 form-label me-2">أقصر استراحة بين الورديات (دقيقة)</label>
                        <input type="number" class="form-control" name="shift_min_break_minutes" placeholder="مثال: 15"
                            value="{{ old('shift_min_break_minutes', $record->shift_min_break_minutes ?? '') }}">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        {{-- =================== Box الحضور =================== --}}
        <div class="col-md-12">
            <div class="p-4 mb-4 border rounded">
                <h5 class="mb-4 text-center">إعدادات الحضور في التقرير</h5>

                <div class="row justify-content-center align-items-center">
                    {{-- رمز الحضور --}}
                    <div class="mb-3 col-md-3 d-flex align-items-center">
                        <label class="mb-0 form-label me-2">رمز الحضور</label>
                        <input type="text" class="form-control" name="attendance_symbol" placeholder="مثال: ✔"
                            value="{{ old('attendance_symbol', $record->attendance_symbol ?? '') }}">
                    </div>

                    {{-- لون الحضور --}}
                    <div class="mb-3 col-md-2 d-flex align-items-center">
                        <label class="mb-0 form-label me-2">لون الحضور</label>
                        <input type="color" class="form-control form-control-color" name="attendance_color"
                            value="{{ old('attendance_color', $record->attendance_color ?? '#00ff00') }}">
                    </div>

                    {{-- لون العطلة --}}
                    <div class="mb-3 col-md-2 d-flex align-items-center">
                        <label class="mb-0 form-label me-2">لون العطلة</label>
                        <input type="color" class="form-control form-control-color" name="attendance_holiday_color"
                            value="{{ old('attendance_holiday_color', $record->attendance_holiday_color ?? '#ff0000') }}">
                    </div>

                    {{-- لون الأسبوعية --}}
                    <div class="mb-3 col-md-2 d-flex align-items-center">
                        <label class="mb-0 form-label me-2">لون الأسبوعية</label>
                        <input type="color" class="form-control form-control-color" name="attendance_weekly_color"
                            value="{{ old('attendance_weekly_color', $record->attendance_weekly_color ?? '#0000ff') }}">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <button type="submit" class="btn btn-primary">حفظ</button>
</form>
<!-- End Form -->
