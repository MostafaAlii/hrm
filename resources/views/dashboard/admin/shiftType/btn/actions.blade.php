<div class="d-flex justify-content-center">
    <!-- زرار تعديل -->
    {{--<button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
        data-bs-target="#editShiftTypeModal{{ $shiftType->id }}">
        <i class="fas fa-edit"></i>
    </button>

    <!-- Modal Edit -->
    <div class="modal fade" id="editShiftTypeModal{{ $shiftType->id }}" tabindex="-1" aria-labelledby="editShiftTypeModal"
        aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{ route('admin.shift-types.update', $shiftType->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editShiftTypeLabel">تعديل الشيفت</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="إغلاق"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>نوع الشيفت</label>
                                    <select name="type" id="shiftTypeSelect{{ $shiftType->id }}" class="form-control" required>
                                        @foreach($types as $type)
                                        <option value="{{ $type->value }}" {{ $shiftType->type && $shiftType->type->value == $type->value ? 'selected' : ''
                                            }}>
                                            {{ trans('dashboard/shift_types.' . $type->value) }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4" id="fromTimeField{{ $shiftType->id }}">
                                <div class="form-group">
                                    <label>من الساعة</label>
                                    <input type="time" name="from_time" class="form-control"
                                        value="{{ $shiftType->from_time ? $shiftType->from_time->format('H:i') : '' }}">
                                </div>
                            </div>
                            <div class="col-md-4" id="toTimeField{{ $shiftType->id }}">
                                <div class="form-group">
                                    <label>إلى الساعة</label>
                                    <input type="time" name="to_time" class="form-control"
                                        value="{{ $shiftType->to_time ? $shiftType->to_time->format('H:i') : '' }}">
                                </div>
                            </div>
                            <div class="col-md-4" id="totalHourField{{ $shiftType->id }}">
                                <div class="form-group">
                                    <label>عدد الساعات</label>
                                    <input type="time" name="total_hour" class="form-control"
                                        value="{{ $shiftType->total_hour ? $shiftType->total_hour->format('H:i') : '' }}">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-check">
                                    <input type="checkbox" name="is_active" class="form-check-input" value="1" {{
                                        $shiftType->is_active ? 'checked' : '' }}>
                                    <label class="form-check-label">مفعل</label>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إلغاء</button>
                        <button type="submit" class="btn btn-primary">تحديث</button>
                    </div>
                </div>
            </form>
        </div>
    </div>--}}

    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
        data-bs-target="#editShiftTypeModal{{ $shiftType->id }}">
        <i class="fas fa-edit"></i>
    </button>

    <!-- Modal Edit -->
    <div class="modal fade edit-shift-modal" id="editShiftTypeModal{{ $shiftType->id }}" tabindex="-1"
        aria-labelledby="editShiftTypeModal" aria-hidden="true" data-shift-id="{{ $shiftType->id }}">
        <div class="modal-dialog">
            <form action="{{ route('admin.shift-types.update', $shiftType->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">تعديل الشيفت</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="إغلاق"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>نوع الشيفت</label>
                                    <!-- class بدلاً من id -->
                                    <select name="type" class="form-control shift-type-select" required>
                                        @foreach($types as $type)
                                        <option value="{{ $type->value }}" {{ ($shiftType->type?->value ?? null) ==
                                            $type->value ? 'selected' : '' }}>
                                            {{ trans('dashboard/shift_types.' . $type->value) }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <!-- استخدمت كلاسات لكل field -->
                            <div class="col-md-4 from-time-field"
                                style="{{ ($shiftType->type?->value === 'flexible') ? 'display:none;' : '' }}">
                                <div class="form-group">
                                    <label>من الساعة</label>
                                    <input type="time" name="from_time" class="form-control"
                                        value="{{ $shiftType->from_time ? $shiftType->from_time->format('H:i') : '' }}">
                                </div>
                            </div>

                            <div class="col-md-4 to-time-field"
                                style="{{ ($shiftType->type?->value === 'flexible') ? 'display:none;' : '' }}">
                                <div class="form-group">
                                    <label>إلى الساعة</label>
                                    <input type="time" name="to_time" class="form-control"
                                        value="{{ $shiftType->to_time ? $shiftType->to_time->format('H:i') : '' }}">
                                </div>
                            </div>

                            <div class="col-md-4 total-hour-field">
                                <div class="form-group">
                                    <label>عدد الساعات</label>
                                    <input type="time" name="total_hour" class="form-control"
                                        value="{{ $shiftType->total_hour ? $shiftType->total_hour->format('H:i') : '' }}">
                                </div>
                            </div>
                        </div>

                        <div class="row mt-2">
                            <div class="col-md-6">
                                <div class="form-check">
                                    <input type="checkbox" name="is_active" class="form-check-input" value="1" {{
                                        $shiftType->is_active ? 'checked' : '' }}>
                                    <label class="form-check-label">مفعل</label>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إلغاء</button>
                        <button type="submit" class="btn btn-primary">تحديث</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Delete Button (Optional) -->
    <button type="button" class="mx-1 btn btn-danger btn-sm" data-bs-toggle="modal"
        data-bs-target="#deleteModal{{ $shiftType->id }}">
        <i class="fas fa-trash"></i>
    </button>

    <div class="modal fade" id="deleteModal{{ $shiftType->id }}" tabindex="-1" aria-labelledby="deleteModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">تأكيد الحذف</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="إغلاق"></button>
                </div>
                <div class="text-center modal-body">
                    <p>هل أنت متأكد من حذف "<strong>{{ $shiftType->type_label }}</strong>"؟</p>
                    <p class="text-danger">هذا الإجراء لا يمكن التراجع عنه.</p>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إلغاء</button>
                        <form action="{{ route('admin.shift-types.destroy', $shiftType->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">نعم، حذف</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
