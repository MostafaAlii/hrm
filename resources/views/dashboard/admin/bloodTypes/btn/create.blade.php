<!-- Modal Create -->
<div class="modal fade" id="createBranchModal" tabindex="-1" aria-labelledby="createBranchLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('admin.bloodType.store') }}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createBranchLabel">إضافة متغيرات فصائل دم جديده</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="إغلاق"></button>
                </div>
                <div class="modal-body">

                    <div class="mb-3">
                        <label class="form-label">وصف عربى</label>
                        <input type="text" name="name_ar" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">وصف انجليزى</label>
                        <input type="text" name="name_en" class="form-control" required>
                    </div>

                    <div class="mb-3 form-check">
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
