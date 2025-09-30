<div class="tab-pane fade" id="employee-licenses" role="tabpanel" aria-labelledby="employee-licenses-tab">
    <div class="mb-2 d-flex justify-content-between">
        <h5 class="mt-2 mb-3 section-title">
            التراخيص
            <span>{{ '( ' . $record?->name_ar . ' )' }}</span>
        </h5>
        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#createLicenseModal">
            <i class="fa fa-plus"></i> إضافة
        </button>
    </div>

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>نوع الرخصة</th>
                <th>رقم الرخصة</th>
                <th>تاريخ الصدور</th>
                <th>تاريخ الانتهاء</th>
                <th>جهة الصدور</th>
                <th>ملاحظات</th>
                <th>الإجراءات</th>
            </tr>
        </thead>
        <tbody>
            @forelse($licenses ?? [] as $license)
            <tr>
                <td>{{ $license->licenseVariable?->name_ar }}</td>
                <td>{{ $license->license_number }}</td>
                <td>{{ $license->issue_date ? \Carbon\Carbon::parse($license->issue_date)->format('Y-m-d') : '-' }}</td>
                <td>{{ $license->expiry_date ? \Carbon\Carbon::parse($license->expiry_date)->format('Y-m-d') : '-' }}
                </td>
                <td>{{ $license->issuing_authority }}</td>
                <td>{{ $license->notes ?? '-' }}</td>
                <td>
                    <div class="btn-group">
                        <button type="button" class="btn btn-sm btn-warning" data-bs-toggle="modal"
                            data-bs-target="#editLicenseModal{{ $license->id }}">
                            <i class="fa fa-edit"></i>
                        </button>
                        <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal"
                            data-bs-target="#deleteLicenseModal{{ $license->id }}">
                            <i class="fa fa-trash"></i>
                        </button>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" class="text-center">لا توجد بيانات</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <!-- Modal الإضافة -->
    <div class="modal fade" id="createLicenseModal" tabindex="-1" aria-labelledby="createLicenseModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <form action="{{ route('admin.employee.licenses.store', $record->id) }}" method="POST">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="createLicenseModalLabel">إضافة رخصة</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="إغلاق"></button>
                    </div>
                    <div class="modal-body row g-3">
                        <div class="col-md-6">
                            <label class="form-label">نوع الرخصة <span class="text-danger">*</span></label>
                            <select name="license_variable_id" class="form-select" required>
                                <option value="">-- اختر --</option>
                                @foreach($licenseVariables ?? [] as $variable)
                                <option value="{{ $variable->id }}">{{ $variable->name_ar }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">رقم الرخصة <span class="text-danger">*</span></label>
                            <input type="text" name="license_number" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">تاريخ الصدور <span class="text-danger">*</span></label>
                            <input type="date" name="issue_date" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">تاريخ الانتهاء <span class="text-danger">*</span></label>
                            <input type="date" name="expiry_date" class="form-control" required>
                        </div>
                        <div class="col-md-12">
                            <label class="form-label">جهة الصدور <span class="text-danger">*</span></label>
                            <input type="text" name="issuing_authority" class="form-control" required>
                        </div>
                        <div class="col-md-12">
                            <label class="form-label">ملاحظات</label>
                            <textarea name="notes" class="form-control" rows="3"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إلغاء</button>
                        <button type="submit" class="btn btn-primary">حفظ</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Modals التعديل والحذف لكل رخصة -->
    @foreach($licenses ?? [] as $license)
    <!-- Modal التعديل -->
    <div class="modal fade" id="editLicenseModal{{ $license->id }}" tabindex="-1"
        aria-labelledby="editLicenseModalLabel{{ $license->id }}" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <form
                action="{{ route('admin.employee.licenses.update', ['employee' => $record->id, 'license' => $license->id]) }}"
                method="POST">
                @csrf
                @method('PUT')
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editLicenseModalLabel{{ $license->id }}">تعديل الرخصة</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="إغلاق"></button>
                    </div>
                    <div class="modal-body row g-3">
                        <div class="col-md-6">
                            <label class="form-label">نوع الرخصة <span class="text-danger">*</span></label>
                            <select name="license_variable_id" class="form-select" required>
                                <option value="">-- اختر --</option>
                                @foreach($licenseVariables ?? [] as $variable)
                                <option value="{{ $variable->id }}" {{ $license->license_variable_id == $variable->id ?
                                    'selected' : '' }}>
                                    {{ $variable->name_ar }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">رقم الرخصة <span class="text-danger">*</span></label>
                            <input type="text" name="license_number" class="form-control"
                                value="{{ $license->license_number }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">تاريخ الصدور <span class="text-danger">*</span></label>
                            <input type="date" name="issue_date" class="form-control"
                                value="{{ $license->issue_date ? \Carbon\Carbon::parse($license->issue_date)->format('Y-m-d') : '' }}"
                                required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">تاريخ الانتهاء <span class="text-danger">*</span></label>
                            <input type="date" name="expiry_date" class="form-control"
                                value="{{ $license->expiry_date ? \Carbon\Carbon::parse($license->expiry_date)->format('Y-m-d') : '' }}"
                                required>
                        </div>
                        <div class="col-md-12">
                            <label class="form-label">جهة الصدور <span class="text-danger">*</span></label>
                            <input type="text" name="issuing_authority" class="form-control"
                                value="{{ $license->issuing_authority }}" required>
                        </div>
                        <div class="col-md-12">
                            <label class="form-label">ملاحظات</label>
                            <textarea name="notes" class="form-control" rows="3">{{ $license->notes }}</textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إلغاء</button>
                        <button type="submit" class="btn btn-primary">تحديث</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal الحذف -->
    <div class="modal fade" id="deleteLicenseModal{{ $license->id }}" tabindex="-1"
        aria-labelledby="deleteLicenseModalLabel{{ $license->id }}" aria-hidden="true">
        <div class="modal-dialog">
            <form
                action="{{ route('admin.employee.licenses.destroy', ['employee' => $record->id, 'license' => $license->id]) }}"
                method="POST">
                @csrf
                @method('DELETE')
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteLicenseModalLabel{{ $license->id }}">تأكيد الحذف</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="إغلاق"></button>
                    </div>
                    <div class="modal-body">
                        <p>هل أنت متأكد من حذف الرخصة: <strong>{{ $license->licenseVariable?->name_ar }}</strong>؟</p>
                        <p class="text-danger">هذا الإجراء لا يمكن التراجع عنه.</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إلغاء</button>
                        <button type="submit" class="btn btn-danger">حذف</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    @endforeach
</div>
