<div class="d-flex justify-content-center">
    <!-- زرار تعديل -->
    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
        data-bs-target="#editOccasionModal{{ $occasion->id }}">
        <i class="fas fa-edit"></i>
    </button>

    <!-- Modal Edit -->
    <div class="modal fade" id="editOccasionModal{{ $occasion->id }}" tabindex="-1"
        aria-labelledby="editOccasionLabel{{ $occasion->id }}" aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{ route('admin.occasions.update', $occasion->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editOccasionLabel{{ $occasion->id }}">تعديل عطله</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="إغلاق"></button>
                    </div>
                    <div class="modal-body">

                        <div class="mb-3">
                            <label class="form-label">اسم العطله</label>
                            <input type="text" name="name" class="form-control" value="{{ $occasion->name }}"
                                required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">من تاريخ</label>
                            <input type="date" name="from_date" class="form-control"
                                value="{{ $occasion->from_date ? $occasion->from_date->format('Y-m-d') : '' }}" required>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">إلى تاريخ</label>
                            <input type="date" name="to_date" class="form-control"
                                value="{{ $occasion->to_date ? $occasion->to_date->format('Y-m-d') : '' }}" required>
                        </div>

                        <div class="form-check mb-3">
                            <input type="checkbox" name="is_active" class="form-check-input" value="1"
                                id="is_active_edit{{ $occasion->id }}" {{ $occasion->is_active ? 'checked' :
                            '' }}>
                            <label class="form-check-label" for="is_active_edit{{ $occasion->id }}">مفعل</label>
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
        data-bs-target="#deleteModal{{ $occasion->id }}">
        <i class="fas fa-trash"></i>
    </button>

    <div class="modal fade" id="deleteModal{{ $occasion->id }}" tabindex="-1" aria-labelledby="deleteModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">تأكيد الحذف</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="إغلاق"></button>
                </div>
                <div class="text-center modal-body">
                    <p>هل أنت متأكد من حذف "<strong>{{ $occasion->name }}</strong>"؟</p>
                    <p class="text-danger">هذا الإجراء لا يمكن التراجع عنه.</p>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إلغاء</button>
                        <form action="{{ route('admin.occasions.destroy', $occasion->id) }}" method="POST">
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