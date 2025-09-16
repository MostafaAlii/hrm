<div class="d-flex justify-content-center">
    <!-- زرار تعديل -->
    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
        data-bs-target="#editBranchModal{{ $governorate->id }}">
        <i class="fas fa-edit"></i>
    </button>

    <!-- Modal Edit -->
    <div class="modal fade" id="editBranchModal{{ $governorate->id }}" tabindex="-1"
        aria-labelledby="editBranchLabel{{ $governorate->id }}" aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{ route('admin.governorate.update', $governorate->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editBranchLabel{{ $governorate->id }}">تعديل محافظه
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="إغلاق"></button>
                    </div>
                    <div class="modal-body">

                        <div class="mb-3">
                            <label class="form-label">وصف عربى</label>
                            <input type="text" name="name_ar" class="form-control" value="{{ $governorate->name_ar }}"
                                required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">وصف انجليزى</label>
                            <input type="text" name="name_en" class="form-control" value="{{ $governorate->name_en }}"
                                required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">بدل الانتقال</label>
                            <input type="number" step="0.01" name="transportation_allowance" class="form-control"
                                value="{{ $governorate->transportation_allowance }}" required>
                        </div>

                        <div class="mb-3 form-check">
                            <input type="checkbox" name="is_active" class="form-check-input" value="1"
                                id="is_active_edit{{ $governorate->id }}" {{ $governorate->is_active ? 'checked'
                            : '' }}>
                            <label class="form-check-label" for="is_active_edit{{ $governorate->id }}">مفعل</label>
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
        data-bs-target="#deleteModal{{ $governorate->id }}">
        <i class="fas fa-trash"></i>
    </button>

    <div class="modal fade" id="deleteModal{{ $governorate->id }}" tabindex="-1" aria-labelledby="deleteModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">تأكيد الحذف</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="إغلاق"></button>
                </div>
                <div class="text-center modal-body">
                    <p>هل أنت متأكد من حذف "<strong>{{ $governorate->name_ar }}</strong>"؟</p>
                    <p class="text-danger">هذا الإجراء لا يمكن التراجع عنه.</p>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إلغاء</button>
                        <form action="{{ route('admin.governorate.destroy', $governorate->id) }}" method="POST">
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
