<div class="d-flex justify-content-center">
    <!-- زرار تعديل -->
    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
        data-bs-target="#editDepartmentModal{{ $r->id }}">
        <i class="fas fa-edit"></i>
    </button>

    <!-- Modal Edit -->
    <div class="modal fade" id="editDepartmentModal{{ $r->id }}" tabindex="-1"
        aria-labelledby="editDepartmentLabel{{ $r->id }}" aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{ route('admin.employee-leave-allocation.update', $r->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editDepartmentLabel{{ $r->id }}">تعديل </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="إغلاق"></button>
                    </div>
                    <div class="modal-body">
                        <!-- كود الإجازة readonly -->
                        <div class="mb-3">
                            <label class="form-label fw-bold">كود الإجازة</label>
                            <input type="text" class="form-control" value="{{ $r->leaveVariable?->code }}" readonly>
                        </div>
                        <!-- الرصيد المخصص -->
                        <div class="mb-3">
                            <label class="form-label fw-bold">الرصيد المخصص</label>
                            <input type="number" step="0.01" name="allocated_balance" class="form-control"
                                value="{{ old('allocated_balance', $r->allocated_balance) }}" required>
                        </div>

                        <!-- رصيد السنوات السابقة -->
                        <div class="mb-3">
                            <label class="form-label fw-bold">رصيد السنوات السابقة</label>
                            <input type="number" step="0.01" name="previous_years_balance" class="form-control"
                                value="{{ old('previous_years_balance', $r->previous_years_balance) }}" required>
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
        data-bs-target="#deleteModal{{ $r->id }}">
        <i class="fas fa-trash"></i>
    </button>

    <div class="modal fade" id="deleteModal{{ $r->id }}" tabindex="-1" aria-labelledby="deleteModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">تأكيد الحذف</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="إغلاق"></button>
                </div>
                <div class="text-center modal-body">
                    <p>هل أنت متأكد من حذف "<strong>{{ $r->leaveVariable?->name_ar }}</strong>"؟</p>
                    <p class="text-danger">هذا الإجراء لا يمكن التراجع عنه.</p>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إلغاء</button>
                        <form action="{{ route('admin.employee-leave-allocation.destroy', $r->id) }}" method="POST">
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
