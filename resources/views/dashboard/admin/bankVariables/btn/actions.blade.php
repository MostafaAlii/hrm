<div class="d-flex justify-content-center">
    <!-- زرار تعديل -->
    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
        data-bs-target="#editBranchModal{{ $bankVariable->id }}">
        <i class="fas fa-edit"></i>
    </button>

    <!-- Modal Edit -->
    <div class="modal fade" id="editBranchModal{{ $bankVariable->id }}" tabindex="-1"
        aria-labelledby="editBranchLabel{{ $bankVariable->id }}" aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{ route('admin.bankVariable.update', $bankVariable->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editBranchLabel{{ $bankVariable->id }}">تعديل متغيرات البنوك
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="إغلاق"></button>
                    </div>
                    <div class="modal-body">

                        <div class="mb-3">
                            <label class="form-label">وصف عربى</label>
                            <input type="text" name="name_ar" class="form-control"
                                value="{{ $bankVariable->name_ar }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">وصف انجليزى</label>
                            <input type="text" name="name_en" class="form-control"
                                value="{{ $bankVariable->name_en }}" required>
                        </div>

                        <div class="mb-3">
                            <label>جهة الاتصال</label>
                            <input type="text" name="contact_person" class="form-control" value="{{ $bankVariable->contact_person }}">
                        </div>

                        <div class="mb-3">
                            <label>رقم الهاتف</label>
                            <input type="text" name="phone_number" class="form-control" value="{{ $bankVariable->phone_number }}">
                        </div>

                        <div class="mb-3 form-check">
                            <input type="checkbox" name="is_active" class="form-check-input" value="1"
                                id="is_active_edit{{ $bankVariable->id }}" {{ $bankVariable->is_active ? 'checked'
                            : '' }}>
                            <label class="form-check-label" for="is_active_edit{{ $bankVariable->id }}">مفعل</label>
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
        data-bs-target="#deleteModal{{ $bankVariable->id }}">
        <i class="fas fa-trash"></i>
    </button>

    <div class="modal fade" id="deleteModal{{ $bankVariable->id }}" tabindex="-1" aria-labelledby="deleteModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">تأكيد الحذف</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="إغلاق"></button>
                </div>
                <div class="text-center modal-body">
                    <p>هل أنت متأكد من حذف "<strong>{{ $bankVariable->name_ar }}</strong>"؟</p>
                    <p class="text-danger">هذا الإجراء لا يمكن التراجع عنه.</p>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إلغاء</button>
                        <form action="{{ route('admin.bankVariable.destroy', $bankVariable->id) }}" method="POST">
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
