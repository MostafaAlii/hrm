<div class="tab-pane fade show" id="insurance-history" role="tabpanel" aria-labelledby="insurance-history-tab">
    <form method="POST" action="{{ route('admin.employee.insurance.update', $record->id) }}"
        class="p-4 bg-light rounded shadow-sm border">
        @csrf
        @method('PUT')
        <div class="row mb-4">
            <div class="col-md-4">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="is_insured" id="is_insured" {{
                        $record?->latestInsurance?->is_insured ? 'checked' : '' }}>
                    <label class="form-check-label fw-bold" for="is_insured">مؤمن عليه</label>
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="salary_insurance" id="salary_insurance" {{
                        $record?->latestInsurance?->salary_insurance ? 'checked' : '' }}>
                    <label class="form-check-label fw-bold" for="salary_insurance">معالجة التأمين في المرتب</label>
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="employee_fund" id="employee_fund" {{
                        $record?->latestInsurance?->employee_fund ? 'checked' : '' }}>
                    <label class="form-check-label fw-bold" for="employee_fund">صندوق العاملين</label>
                </div>
            </div>
        </div>

        <!-- ✅ بيانات التأمين -->
        <div class="card mb-4 border-primary">
            <div class="card-header bg-primary text-white fw-bold">بيانات التأمين</div>
            <div class="card-body row g-3">
                <div class="col-md-6">
                    <label class="form-label fw-bold">نوع التأمين</label>
                    <select name="insurance_type_id" class="form-select">
                        <option value="">اختر</option>
                        @foreach($insuranceTypes as $type)
                        <option value="{{ $type->id }}" {{ $record?->latestInsurance?->insurance_type_id == $type->id ?
                            'selected' : '' }}>
                            {{ $type->name_ar }}
                        </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-6">
                    <label class="form-label fw-bold">تاريخ التأمين</label>
                    <input type="date" name="insurance_date"
                        value="{{ old('insurance_date', $record?->latestInsurance?->insurance_date?->format('Y-m-d')) }}"
                        class="form-control">
                </div>

                <div class="col-md-6">
                    <label class="form-label fw-bold">الرقم التأميني</label>
                    <input type="text" name="insurance_number" value="{{ $record?->latestInsurance?->insurance_number }}"
                        class="form-control">
                </div>

                <div class="col-md-6">
                    <label class="form-label fw-bold">المنطقة</label>
                    <select name="insurance_region_id" class="form-select">
                        <option value="">اختر</option>
                        @foreach($insuranceRegions as $region)
                        <option value="{{ $region->id }}" {{ $record?->latestInsurance?->insurance_region_id == $region->id ?
                            'selected' : '' }}>
                            {{ $region->name_ar }}
                        </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-6">
                    <label class="form-label fw-bold">مكتب التأمين</label>
                    <select name="insurance_office_id" class="form-select">
                        <option value="">اختر</option>
                        @foreach($insuranceOffices as $office)
                        <option value="{{ $office->id }}" {{ $record?->latestInsurance?->insurance_office_id == $office->id ?
                            'selected' : '' }}>
                            {{ $office->name_ar }}
                        </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <!-- ✅ حالة التأمين الصحي -->
        <div class="card mb-4 border-primary">
            <div class="card-header bg-primary text-white fw-bold">حالة التأمين الصحي</div>
            <div class="card-body">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="is_health_insured" id="is_health_insured" {{
                        $record?->latestInsurance?->is_health_insured ? 'checked' : '' }}>
                    <label class="form-check-label fw-bold" for="is_health_insured">يخضع للتأمين الصحي الشامل</label>
                </div>
            </div>
        </div>

        <!-- ✅ أخرى -->
        <div class="card mb-4 border-primary">
            <div class="card-header bg-primary text-white fw-bold">أخرى</div>
            <div class="card-body row g-3">
                <div class="col-md-6">
                    <label class="form-label fw-bold">عدد الزوجات الغير عاملات</label>
                    <input type="number" name="non_dependents_count"
                        value="{{ $record?->latestInsurance?->non_dependents_count ?? 0 }}" class="form-control">
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-bold">عدد المعالين</label>
                    <input type="number" name="dependents_count"
                        value="{{ $record?->latestInsurance?->dependents_count ?? 0 }}" class="form-control">
                </div>
            </div>
        </div>

        <!-- ✅ الحصص -->
        <div class="card mb-4 border-primary">
            <div class="card-header bg-primary text-white fw-bold">الحصص</div>
            <div class="card-body row g-3">
                <div class="col-md-4">
                    <label class="form-label fw-bold">المبلغ التأميني</label>
                    <input type="number" step="0.01" name="insurance_amount" value="{{ $record?->latestInsurance?->insurance_amount ?? 0 }}"
                        class="form-control bg-light text-primary fw-bold" readonly>
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-bold">حصة العامل</label>
                    <input type="number" step="0.01" name="employee_share" value="{{ $record?->latestInsurance?->employee_share ?? 0 }}"
                        class="form-control bg-light text-success fw-bold" readonly>
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-bold">حصة الشركة</label>
                    <input type="number" step="0.01" name="company_share"
                        value="{{ $record?->latestInsurance?->company_share ?? 0 }}"
                        class="form-control bg-light text-danger fw-bold" readonly>
                </div>
            </div>
        </div>

        <!-- زر الحفظ -->
        <div class="mt-4 text-end">
            <button type="submit" class="btn btn-success px-4">
                <i class="fa fa-save"></i> حفظ
            </button>
        </div>
    </form>
</div>
