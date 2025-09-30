<div class="tab-pane fade" id="employee-benefits" role="tabpanel" aria-labelledby="employee-benefits-tab">
    <div class="mb-2 d-flex justify-content-between">
        <h5 class="mt-2 mb-3 section-title">
            مزايا الموظف
            <span>{{ '( ' . $record?->name_ar . ' )' }}</span>
        </h5>
        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#createBenefitModal">
            <i class="fa fa-plus"></i> إضافة
        </button>
    </div>

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>الميزة</th>
                <th>تاريخ الحصول</th>
                <th>تاريخ السحب</th>
                <th>سبب السحب</th>
                <th>الحالة</th>
                <th>ملاحظات</th>
                <th>الإجراءات</th>
            </tr>
        </thead>
        <tbody>
            @forelse($benefits ?? [] as $benefit)
            <tr>
                <td>{{ $benefit->benefitVariable?->name_ar }}</td>
                <td>{{ $benefit->benefit_date ? \Carbon\Carbon::parse($benefit->benefit_date)->format('Y-m-d') : '-' }}
                </td>
                <td>{{ $benefit->withdrawal_date ? \Carbon\Carbon::parse($benefit->withdrawal_date)->format('Y-m-d') :
                    '-' }}</td>
                <td>{{ $benefit->withdrawal_reason ?? '-' }}</td>
                <td>{!! $benefit->benefit_status_badge !!}</td>
                <td>{{ $benefit->notes ?? '-' }}</td>
                <td>
                    <div class="btn-group">
                        <button type="button" class="btn btn-sm btn-warning" data-bs-toggle="modal"
                            data-bs-target="#editBenefitModal{{ $benefit->id }}">
                            <i class="fa fa-edit"></i>
                        </button>
                        <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal"
                            data-bs-target="#deleteBenefitModal{{ $benefit->id }}">
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
    <div class="modal fade" id="createBenefitModal" tabindex="-1" aria-labelledby="createBenefitModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <form action="{{ route('admin.employee.benefits.store', $record->id) }}" method="POST">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="createBenefitModalLabel">إضافة ميزة</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="إغلاق"></button>
                    </div>
                    <div class="modal-body row g-3">
                        <div class="col-md-6">
                            <label class="form-label">الميزة <span class="text-danger">*</span></label>
                            <select name="benefit_variable_id" class="form-select" required>
                                <option value="">-- اختر --</option>
                                @foreach($benefitVariables ?? [] as $variable)
                                <option value="{{ $variable->id }}">{{ $variable->name_ar }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">تاريخ الحصول على الميزة <span class="text-danger">*</span></label>
                            <input type="date" name="benefit_date" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">تاريخ سحب الميزة</label>
                            <input type="date" name="withdrawal_date" class="form-control">
                        </div>
                        <div class="col-md-12">
                            <label class="form-label">سبب سحب الميزة</label>
                            <textarea name="withdrawal_reason" class="form-control" rows="2"></textarea>
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

    <!-- Modals التعديل والحذف لكل ميزة -->
    @foreach($benefits ?? [] as $benefit)
    <!-- Modal التعديل -->
    <div class="modal fade" id="editBenefitModal{{ $benefit->id }}" tabindex="-1"
        aria-labelledby="editBenefitModalLabel{{ $benefit->id }}" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <form
                action="{{ route('admin.employee.benefits.update', ['employee' => $record->id, 'benefit' => $benefit->id]) }}"
                method="POST">
                @csrf
                @method('PUT')
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editBenefitModalLabel{{ $benefit->id }}">تعديل الميزة</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="إغلاق"></button>
                    </div>
                    <div class="modal-body row g-3">
                        <div class="col-md-6">
                            <label class="form-label">الميزة <span class="text-danger">*</span></label>
                            <select name="benefit_variable_id" class="form-select" required>
                                <option value="">-- اختر --</option>
                                @foreach($benefitVariables ?? [] as $variable)
                                <option value="{{ $variable->id }}" {{ $benefit->benefit_variable_id == $variable->id ?
                                    'selected' : '' }}>
                                    {{ $variable->name_ar }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">تاريخ الحصول على الميزة <span class="text-danger">*</span></label>
                            <input type="date" name="benefit_date" class="form-control"
                                value="{{ $benefit->benefit_date ? \Carbon\Carbon::parse($benefit->benefit_date)->format('Y-m-d') : '' }}"
                                required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">تاريخ سحب الميزة</label>
                            <input type="date" name="withdrawal_date" class="form-control"
                                value="{{ $benefit->withdrawal_date ? \Carbon\Carbon::parse($benefit->withdrawal_date)->format('Y-m-d') : '' }}">
                        </div>
                        <div class="col-md-12">
                            <label class="form-label">سبب سحب الميزة</label>
                            <textarea name="withdrawal_reason" class="form-control"
                                rows="2">{{ $benefit->withdrawal_reason }}</textarea>
                        </div>
                        <div class="col-md-12">
                            <label class="form-label">ملاحظات</label>
                            <textarea name="notes" class="form-control" rows="3">{{ $benefit->notes }}</textarea>
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
    <div class="modal fade" id="deleteBenefitModal{{ $benefit->id }}" tabindex="-1"
        aria-labelledby="deleteBenefitModalLabel{{ $benefit->id }}" aria-hidden="true">
        <div class="modal-dialog">
            <form
                action="{{ route('admin.employee.benefits.destroy', ['employee' => $record->id, 'benefit' => $benefit->id]) }}"
                method="POST">
                @csrf
                @method('DELETE')
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteBenefitModalLabel{{ $benefit->id }}">تأكيد الحذف</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="إغلاق"></button>
                    </div>
                    <div class="modal-body">
                        <p>هل أنت متأكد من حذف الميزة: <strong>{{ $benefit->benefitVariable?->name_ar }}</strong>؟</p>
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
