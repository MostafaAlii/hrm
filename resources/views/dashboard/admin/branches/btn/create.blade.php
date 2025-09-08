<!-- Modal Create -->
<div class="modal fade" id="createBranchModal" tabindex="-1" aria-labelledby="createBranchLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('admin.branchs.store') }}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createBranchLabel">إضافة فرع جديد</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="إغلاق"></button>
                </div>
                <div class="modal-body">

                    <div class="mb-3">
                        <label class="form-label">اسم الفرع</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">العنوان</label>
                        <textarea name="address" class="form-control"></textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">رقم الهاتف</label>
                        <input type="text" name="phone" class="form-control">
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