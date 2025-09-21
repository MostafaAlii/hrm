<div class="d-flex justify-content-center">
    <!-- زرار تعديل -->
    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
        data-bs-target="#editOfficeModal{{ $insuranceType->id }}">
        <i class="fas fa-edit"></i>
    </button>

    <!-- Modal Edit -->
    <div class="modal fade" id="editOfficeModal{{ $insuranceType->id }}" tabindex="-1"
        aria-labelledby="editOfficeLabel{{ $insuranceType->id }}" aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{ route('admin.insurance-types.update', $insuranceType->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editOfficeLabel{{ $insuranceType->id }}">تعديل نوع تامين</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="إغلاق"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">الكود</label>
                            <input type="text" name="code" class="form-control" value="{{ $insuranceType->code }}"
                                >
                        </div>

                        <div class="mb-3">
                            <label class="form-label">اسم عربى</label>
                            <input type="text" name="name_ar" class="form-control" value="{{ $insuranceType->name_ar }}"
                                required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">اسم انجليزى</label>
                            <input type="text" name="name_en" class="form-control" value="{{ $insuranceType->name_en }}"
                                >
                        </div>

                        <div class="mb-3">
                            <label class="form-label">نسبه الموظف</label>
                            <input type="text" name="employee_percentage" class="form-control" value="{{ $insuranceType->employee_percentage }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">نسبه الشركه</label>
                            <input type="text" name="company_percentage" class="form-control" value="{{ $insuranceType->company_percentage }}">
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

    <!-- Delete Button -->
    <button type="button" class="mx-1 btn btn-danger btn-sm" data-bs-toggle="modal"
        data-bs-target="#deleteOfficeModal{{ $insuranceType->id }}">
        <i class="fas fa-trash"></i>
    </button>

    <div class="modal fade" id="deleteOfficeModal{{ $insuranceType->id }}" tabindex="-1"
        aria-labelledby="deleteOfficeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteOfficeModalLabel">تأكيد الحذف</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="إغلاق"></button>
                </div>
                <div class="text-center modal-body">
                    <p>هل أنت متأكد من حذف "<strong>{{ $insuranceType->name_ar }}</strong>"؟</p>
                    <p class="text-danger">هذا الإجراء لا يمكن التراجع عنه.</p>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إلغاء</button>
                        <form action="{{ route('admin.insurance-types.destroy', $insuranceType->id) }}" method="POST">
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
