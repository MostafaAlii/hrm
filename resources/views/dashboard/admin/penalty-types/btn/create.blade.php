<!-- Modal Create -->
<div class="modal fade" id="createPenaltyModal" tabindex="-1" aria-labelledby="createPenaltyLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form action="{{ route('admin.penalty-types.store') }}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createPenaltyLabel">إضافة جزاء</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="إغلاق"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3 row">
                        <div class="col-md-6">
                            <label for="name_ar" class="form-label">الوصف العربي</label>
                            <input type="text" name="name_ar" id="name_ar" class="form-control"
                                value="{{ old('name_ar') }}">
                        </div>
                        <div class="col-md-6">
                            <label for="name_en" class="form-label">الوصف الإنجليزي</label>
                            <input type="text" name="name_en" id="name_en" class="form-control"
                                value="{{ old('name_en') }}">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <div class="col-md-6">
                            <label class="form-label">نوع الجزاء</label>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="type" id="type_warning"
                                    value="warning">
                                <label class="form-check-label" for="type_warning">إنذار</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="type" id="type_deduction"
                                    value="deduction">
                                <label class="form-check-label" for="type_deduction">خصم</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="type" id="type_other" value="other"
                                    checked>
                                <label class="form-check-label" for="type_other">آخر</label>
                            </div>
                        </div>
                        <br>
                        <div class="col-md-6 d-flex align-items-center">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="affects_salary"
                                    id="affects_salary" value="1">
                                <label class="form-check-label" for="affects_salary">يؤثر على المرتب</label>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label class="form-label d-block"></label>
                        <div class="flex-wrap gap-3 d-flex">
                            @foreach(\App\Enums\Penalty\CalculationType::labels() as $key => $label)
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="calculation_type" value="{{ $key }}" {{ $loop->first ?
                                'checked' : '' }}>
                                <label class="form-check-label">{{ $label }}</label>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="mb-2 row">
                        <div class="col-md-6">
                            <label class="form-label">للمرة الأولى</label>
                            <input type="number" step="0.01" name="first_time" class="form-control" value="0.00">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label"></label>
                            <input type="text" name="first_time_description" class="form-control">
                        </div>
                    </div>

                    <div class="mb-2 row">
                        <div class="col-md-6">
                            <label class="form-label">للمرة الثانية</label>
                            <input type="number" step="0.01" name="second_time" class="form-control" value="0.00">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label"></label>
                            <input type="text" name="second_time_description" class="form-control">
                        </div>
                    </div>

                    <div class="mb-2 row">
                        <div class="col-md-6">
                            <label class="form-label">للمرة الثالثة</label>
                            <input type="number" step="0.01" name="third_time" class="form-control" value="0.00">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label"></label>
                            <input type="text" name="third_time_description" class="form-control">
                        </div>
                    </div>

                    <div class="mb-2 row">
                        <div class="col-md-6">
                            <label class="form-label">للمرة الرابعة</label>
                            <input type="number" step="0.01" name="fourth_time" class="form-control" value="0.00">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label"></label>
                            <input type="text" name="fourth_time_description" class="form-control">
                        </div>
                    </div>

                    <div class="mb-2 row">
                        <div class="col-md-6">
                            <label class="form-label">أكثر من أربع مرات</label>
                            <input type="number" step="0.01" name="more_than_four_times" class="form-control"
                                value="0.00">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label"></label>
                            <input type="text" name="more_than_four_times_description" class="form-control">
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إلغاء</button>
                    <button type="submit" class="btn btn-success">حفظ</button>
                </div>
            </div>
        </form>
    </div>
</div>
