<div class="btn-group">
    <!-- زر التعديل -->
    <button type="button" class="btn btn-sm btn-warning" data-bs-toggle="modal"
        data-bs-target="#editExpenseTypeModal{{ $record->id }}">
        <i class="fa fa-edit"></i>
    </button>

    <!-- زر الحذف -->
    <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal"
        data-bs-target="#deleteExpenseTypeModal{{ $record->id }}">
        <i class="fa fa-trash"></i>
    </button>
</div>

<!-- Modal التعديل -->
<div class="modal fade" id="editExpenseTypeModal{{ $record->id }}" tabindex="-1"
    aria-labelledby="editExpenseTypeModalLabel{{ $record->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editExpenseTypeModalLabel{{ $record->id }}">تعديل نوع الصرفية</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('admin.expense-types.update', $record->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">الكود <span class="text-danger">*</span></label>
                            <input type="text" name="code" class="form-control" value="{{ $record->code }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">الاسم عربي <span class="text-danger">*</span></label>
                            <input type="text" name="name_ar" class="form-control" value="{{ $record->name_ar }}"
                                required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">الاسم إنجليزي</label>
                            <input type="text" name="name_en" class="form-control" value="{{ $record->name_en }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">الحالة</label>
                            <div class="mt-2 form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="is_active"
                                    id="is_active_{{ $record->id }}" value="1" {{ $record->is_active ? 'checked' : ''
                                }}>
                                <label class="form-check-label" for="is_active_{{ $record->id }}">نشط</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إلغاء</button>
                    <button type="submit" class="btn btn-primary">تحديث</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal الحذف -->
<div class="modal fade" id="deleteExpenseTypeModal{{ $record->id }}" tabindex="-1"
    aria-labelledby="deleteExpenseTypeModalLabel{{ $record->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteExpenseTypeModalLabel{{ $record->id }}">تأكيد الحذف</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('admin.expense-types.destroy', $record->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <div class="modal-body">
                    <p>هل أنت متأكد من حذف نوع الصرفية: <strong>{{ $record->name_ar }}</strong>؟</p>
                    <p class="text-danger">هذا الإجراء لا يمكن التراجع عنه.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إلغاء</button>
                    <button type="submit" class="btn btn-danger">حذف</button>
                </div>
            </form>
        </div>
    </div>
</div>
