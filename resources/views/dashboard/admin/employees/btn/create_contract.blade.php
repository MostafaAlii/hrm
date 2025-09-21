<!-- Modal Create Contract -->
<div class="modal fade" id="createContractModal" tabindex="-1" aria-labelledby="createContractLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('admin.employees.contracts.store', $record->id) }}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createContractLabel">إضافة عقد جديد</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="إغلاق"></button>
                </div>
                <div class="modal-body">

                    <div class="mb-3">
                        <label class="form-label">نوع العقد</label>
                        <select name="contract_type_id" class="form-control" required>
                            <option value="">اختر نوع العقد</option>
                            @foreach($contractTypes as $type)
                            <option value="{{ $type->id }}">{{ $type->name_ar }}</option>
                            @endforeach
                        </select>
                        @error('contract_type_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">الوصف</label>
                        <textarea name="description" class="form-control"></textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">تاريخ بداية العقد</label>
                        <input type="date" name="start_date" value="{{ old('start_date') }}"
                            class="form-control @error('start_date') is-invalid @enderror" required>
                        @error('start_date')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">تاريخ نهاية العقد</label>
                        <input type="date" name="end_date" value="{{ old('end_date') }}"
                            class="form-control @error('end_date') is-invalid @enderror" required>
                        @error('end_date')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">تاريخ التأمينات</label>
                        <input type="date" name="insurance_date" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">تاريخ التجديد</label>
                        <input type="date" name="renewal_date" class="form-control">
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
