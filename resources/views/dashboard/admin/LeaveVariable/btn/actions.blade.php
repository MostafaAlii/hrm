<div class="d-flex justify-content-center">
    <!-- زرار تعديل -->
    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
        data-bs-target="#editBranchModal{{ $record->id }}">
        <i class="fas fa-edit"></i>
    </button>

    <!-- Modal Edit -->
    <div class="modal fade" id="editBranchModal{{ $record->id }}" tabindex="-1"
        aria-labelledby="editBranchLabel{{ $record->id }}" aria-hidden="true" data-color="{{ $record->color }}">
        <div class="modal-dialog modal-lg">
            <form action="{{ route('admin.leave-variables.update', $record->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editBranchLabel{{ $record->id }}">تعديل متغير الاجازات
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="إغلاق"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="mb-3">
                                    <label class="form-label">كود</label>
                                    <input type="text" name="code" class="form-control" value="{{ $record->code }}">
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="mb-3">
                                    <label class="form-label">الرمز</label>
                                    <input type="text" name="symbol" class="form-control" value="{{ $record->symbol }}">
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">وصف عربى</label>
                            <input type="text" name="name_ar" class="form-control" value="{{ $record->name_ar }}"
                                required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">وصف اجنبى</label>
                            <input type="text" name="name_en" class="form-control" value="{{ $record->name_en }}"
                                required>
                        </div>

                        <div class="col-md-6 mb-3 d-flex align-items-center gap-2">
                            <label class="form-label mb-0" style="white-space: nowrap;">اللون</label>

                            <div class="dropdown flex-grow-1">
                                <button class="btn btn-light dropdown-toggle w-100" type="button" id="editColorDropdown{{ $record->id }}"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    اختر اللون
                                </button>

                                <ul class="dropdown-menu p-2" aria-labelledby="editColorDropdown{{ $record->id }}" style="min-width: 200px;">
                                    <div class="d-flex flex-wrap gap-2">
                                        @foreach(['#ff0000','#00a65a','#007bff','#ffc107','#6f42c1','#17a2b8','#000000','#ffffff'] as $color)
                                        <div class="edit-color-option" data-id="{{ $record->id }}" data-color="{{ $color }}"
                                            style="width:30px;height:30px;border-radius:50%;cursor:pointer;border:2px solid #ccc;background:{{ $color }};">
                                        </div>
                                        @endforeach

                                        <!-- Color Picker -->
                                        <div style="width:30px;height:30px;border-radius:50%;border:2px solid #ccc;
                                                    display:flex;align-items:center;justify-content:center;cursor:pointer;">
                                            <i class="fa fa-palette edit-openColorPicker" data-id="{{ $record->id }}"></i>
                                            <input type="color" class="edit-customColorPicker" data-id="{{ $record->id }}"
                                                style="position:absolute;opacity:0;width:30px;height:30px;cursor:pointer;">
                                        </div>
                                    </div>
                                </ul>
                            </div>

                            <input type="hidden" name="color" id="editSelectedColor{{ $record->id }}" required>
                        </div>

                        <div class="col-md-6 mb-3 d-flex align-items-center gap-3">
                            <!-- Checkbox -->
                            <div class="form-check">
                                <input class="form-check-input edit-deduct-checkbox" type="checkbox" name="deduct_from_balance"
                                    id="editDeductCheckbox{{ $record->id }}" data-id="{{ $record->id }}" {{ $record->deduct_from_balance ?
                                'checked' : '' }}>

                                <label class="form-check-label" for="editDeductCheckbox{{ $record->id }}">
                                    يخصم من الرصيد؟
                                </label>
                            </div>

                            <!-- Decimal Input -->
                            <input type="number" step="0.01" name="deducted_value" id="editDeductedValue{{ $record->id }}" class="form-control"
                                placeholder="قيمة الخصم" style="width:150px; {{ $record->deduct_from_balance ? '' : 'display:none;' }}"
                                value="{{ $record->deducted_value }}">
                        </div>

                        <div class="col-12 mb-3">
                            <div class="d-flex gap-3">
                                <!-- الرصيد -->
                                <div class="flex-fill">
                                    <label class="form-label">الرصيد</label>
                                    <input type="number" step="0.01" name="balance" class="form-control" value="{{ $record->balance }}"
                                        placeholder="0.00">
                                </div>
                                <!-- رصيد 10 سنوات -->
                                <div class="flex-fill">
                                    <label class="form-label">رصيد عشر سنوات تأمين</label>
                                    <input type="number" step="0.01" name="ten_years_balance" class="form-control"
                                        value="{{ $record->ten_years_balance }}" placeholder="0.00">
                                </div>
                                <!-- رصيد 50 سنة -->
                                <div class="flex-fill">
                                    <label class="form-label">رصيد خمسين سنة</label>
                                    <input type="number" step="0.01" name="fifty_years_balance" class="form-control"
                                        value="{{ $record->fifty_years_balance }}" placeholder="0.00">
                                </div>
                            </div>
                        </div>

                        <div class="col-12 mb-3">
                            <div class="d-flex flex-wrap gap-4">
                                <!-- يمكن ترحيله -->
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="can_transfer" id="can_transfer{{ $record->id }}" {{
                                        $record->can_transfer ? 'checked' : '' }}>
                                    <label class="form-check-label" for="can_transfer{{ $record->id }}">
                                        يمكن ترحيله
                                    </label>
                                </div>
                                <!-- عشر سنوات تأمين -->
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="ten_years_insurance"
                                        id="ten_years_insurance{{ $record->id }}" {{ $record->ten_years_insurance ? 'checked' : '' }}>
                                    <label class="form-check-label" for="ten_years_insurance{{ $record->id }}">
                                        عشر سنوات تأمين
                                    </label>
                                </div>
                                <!-- خمسين سنة -->
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="fifty_years" id="fifty_years{{ $record->id }}" {{
                                        $record->fifty_years ? 'checked' : '' }}>
                                    <label class="form-check-label" for="fifty_years{{ $record->id }}">
                                        خمسين سنة
                                    </label>
                                </div>
                                <!-- يؤثر على الإجازة السنوية -->
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="affect_annual_leave"
                                        id="affect_annual_leave{{ $record->id }}" {{ $record->affect_annual_leave ? 'checked' : '' }}>
                                    <label class="form-check-label" for="affect_annual_leave{{ $record->id }}">
                                        يؤثر على الإجازة السنوية
                                    </label>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إلغاء</button>
                        <button type="submit" class="btn btn-success">تحديث</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Delete Button (Optional) -->
    <button type="button" class="mx-1 btn btn-danger btn-sm" data-bs-toggle="modal"
        data-bs-target="#deleteModal{{ $record->id }}">
        <i class="fas fa-trash"></i>
    </button>

    <div class="modal fade" id="deleteModal{{ $record->id }}" tabindex="-1" aria-labelledby="deleteModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">تأكيد الحذف</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="إغلاق"></button>
                </div>
                <div class="text-center modal-body">
                    <p>هل أنت متأكد من حذف "<strong>{{ $record->name_ar }}</strong>"؟</p>
                    <p class="text-danger">هذا الإجراء لا يمكن التراجع عنه.</p>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إلغاء</button>
                        <form action="{{ route('admin.leave-variables.destroy', $record->id) }}" method="POST">
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
