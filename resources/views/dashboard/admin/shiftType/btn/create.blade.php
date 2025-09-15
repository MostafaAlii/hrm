<div class="modal fade" id="createShiftTypeModal" tabindex="-1" aria-labelledby="createShiftTypeModal" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('admin.shift-types.store') }}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createShiftTypeLabel">إضافة شيفت جديد</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="إغلاق"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>نوع الشيفت</label>
                                <select name="type" id="shiftTypeSelect" class="form-control" required>
                                    @foreach($types as $type)
                                    <option value="{{ $type->value }}">{{ trans('dashboard/shift_types.' . $type->value) }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4" id="fromTimeField">
                            <div class="form-group">
                                <label>من الساعة</label>
                                <input type="time" name="from_time" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4" id="toTimeField">
                            <div class="form-group">
                                <label>إلى الساعة</label>
                                <input type="time" name="to_time" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4" id="totalHourField">
                            <div class="form-group">
                                <label>عدد الساعات</label>
                                <input type="time" name="total_hour" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-check">
                                <input type="checkbox" name="is_active" class="form-check-input" value="1">
                                <label class="form-check-label">مفعل</label>
                            </div>
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