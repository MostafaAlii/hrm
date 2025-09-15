<!-- Modal Create -->
<div class="modal fade" id="createJobCategoryModal" tabindex="-1" aria-labelledby="createJobCategoryLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('admin.section.store') }}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createJobCategoryLabel">إضافة قسم جديد</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="إغلاق"></button>
                </div>
                <div class="modal-body">

                    <div class="mb-3">
                        <label class="form-label">اسم القسم</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">اختر الإدارة</label>
                        <select name="department_id" class="form-select" required>
                            <option value="">-- اختر الإدارة --</option>
                            @foreach($departments as $department)
                            <option value="{{ $department->id }}">{{ $department->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-check mb-3">
                        <input type="checkbox" name="is_active" class="form-check-input" value="1"
                            id="is_active_create">
                        <label class="form-check-label" for="is_active_create">مفعل</label>
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
