<!-- Modal Create -->
<div class="modal fade" id="createInsuranceOfficeModal" tabindex="-1" aria-labelledby="createInsuranceOfficeLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('admin.insurance-offices.store') }}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createInsuranceOfficeLabel">إضافة مكتب تأمين جديد</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="إغلاق"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">الكود</label>
                        <input type="text" name="code" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">الوصف عربى</label>
                        <input type="text" name="name_ar" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">الوصف اجنبى</label>
                        <input type="text" name="name_en" class="form-control" required>
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
