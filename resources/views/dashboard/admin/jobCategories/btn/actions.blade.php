<div class="d-flex justify-content-center">
    <!-- زرار تعديل -->
    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
        data-bs-target="#editJobCategoryModal{{ $jobCategory->id }}">
        <i class="fas fa-edit"></i>
    </button>

    <!-- Modal Edit -->
    <div class="modal fade" id="editJobCategoryModal{{ $jobCategory->id }}" tabindex="-1"
        aria-labelledby="editJobCategoryLabel{{ $jobCategory->id }}" aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{ route('admin.jobCategories.update', $jobCategory->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editJobCategoryLabel{{ $jobCategory->id }}">تعديل الوظيفه</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="إغلاق"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">اسم الوظيفه</label>
                            <input type="text" name="name" class="form-control" value="{{ $jobCategory->name }}"
                                required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">الإدارة</label>
                            <select name="department_id" id="department_id_edit{{ $jobCategory->id }}" class="form-select department-select"
                            data-job-id="{{ $jobCategory->id }}" required>
                                <option value="">-- اختر الإدارة --</option>
                                @foreach($departments as $department)
                                <option value="{{ $department->id }}" {{ $jobCategory->department_id == $department->id ? 'selected' : '' }}>
                                    {{ $department->name }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">القسم</label>
                            <select name="section_id" id="section_id_edit{{ $jobCategory->id }}" class="form-select section-select"
                                data-selected="{{ $jobCategory->section_id }}" required>
                                <option value="">-- اختر القسم --</option>
                                <!-- الأقسام هتيجي بالـ AJAX -->
                            </select>
                        </div>

                        <div class="form-check mb-3">
                            <input type="checkbox" name="is_active" class="form-check-input" value="1"
                                id="is_active_edit{{ $jobCategory->id }}" {{ $jobCategory->is_active ? 'checked' : ''
                            }}>
                            <label class="form-check-label" for="is_active_edit{{ $jobCategory->id }}">مفعل</label>
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
        data-bs-target="#deleteModal{{ $jobCategory->id }}">
        <i class="fas fa-trash"></i>
    </button>

    <div class="modal fade" id="deleteModal{{ $jobCategory->id }}" tabindex="-1" aria-labelledby="deleteModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">تأكيد الحذف</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="إغلاق"></button>
                </div>
                <div class="text-center modal-body">
                    <p>هل أنت متأكد من حذف "<strong>{{ $jobCategory->name }}</strong>"؟</p>
                    <p class="text-danger">هذا الإجراء لا يمكن التراجع عنه.</p>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إلغاء</button>
                        <form action="{{ route('admin.jobCategories.destroy', $jobCategory->id) }}" method="POST">
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