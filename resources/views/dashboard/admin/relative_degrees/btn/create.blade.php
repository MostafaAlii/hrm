<!-- Modal Create -->
<div class="modal fade" id="createQualificationModal" tabindex="-1" aria-labelledby="createJobCategoryLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('admin.relative-degrees.store') }}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createQualificationLabel">إضافة درجه قرابه جديد</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="إغلاق"></button>
                </div>
                <div class="modal-body">

                    <div class="mb-3">
                        <label class="form-label">وصف عربى</label>
                        <input type="text" name="name_ar" value="{{ old('name_ar') }}" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">وصف اجنبى</label>
                        <input type="text" name="name_en" value="{{ old('name_en') }}" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">نسبة التأمين الصحى الشامل</label>
                        <input type="number" step="0.01" name="insurance_percentage" value="{{ old('insurance_percentage') }}"
                            class="form-control">
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
