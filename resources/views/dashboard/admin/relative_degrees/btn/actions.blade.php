<div class="d-flex justify-content-center">
    <!-- زرار تعديل -->
    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
        data-bs-target="#editQualificationModal{{ $relativeDegree->id }}">
        <i class="fas fa-edit"></i>
    </button>

    <!-- Modal Edit -->
    <div class="modal fade" id="editQualificationModal{{ $relativeDegree->id }}" tabindex="-1"
        aria-labelledby="editJobCategoryLabel{{ $relativeDegree->id }}" aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{ route('admin.relative-degrees.update', $relativeDegree->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editJobCategoryLabel{{ $relativeDegree->id }}">تعديل درجه القرابه</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="إغلاق"></button>
                    </div>
                    <div class="modal-body">

                        <div class="mb-3">
                            <label class="form-label">الوصف عربى</label>
                            <input type="text" name="name_ar" class="form-control" value="{{ old('name_en', $relativeDegree->name_ar) }}"
                                required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">الوصف اجنبى</label>
                            <input type="text" name="name_en" class="form-control" value="{{ old('name_en', $relativeDegree->name_en) }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">نسبة التأمين الصحى الشامل</label>
                            <input type="number" step="0.01" name="insurance_percentage"
                                value="{{ old('insurance_percentage', $relativeDegree->insurance_percentage) }}" class="form-control">
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
        data-bs-target="#deleteModal{{ $relativeDegree->id }}">
        <i class="fas fa-trash"></i>
    </button>

    <div class="modal fade" id="deleteModal{{ $relativeDegree->id }}" tabindex="-1" aria-labelledby="deleteModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">تأكيد الحذف</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="إغلاق"></button>
                </div>
                <div class="text-center modal-body">
                    <p>هل أنت متأكد من حذف "<strong>{{ $relativeDegree->name_ar }}</strong>"؟</p>
                    <p class="text-danger">هذا الإجراء لا يمكن التراجع عنه.</p>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إلغاء</button>
                        <form action="{{ route('admin.relative-degrees.destroy', $relativeDegree->id) }}" method="POST">
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
