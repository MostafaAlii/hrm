{{-- resources/views/dashboard/admin/settings/deduction-variables/btn/actions.blade.php --}}
<div class="btn-group">
    <!-- زر التعديل -->
    <button type="button" class="btn btn-sm btn-warning" data-bs-toggle="modal"
        data-bs-target="#editDeductionVariableModal{{ $record->id }}">
        <i class="fa fa-edit"></i>
    </button>

    <!-- زر الحذف -->
    <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal"
        data-bs-target="#deleteDeductionVariableModal{{ $record->id }}">
        <i class="fa fa-trash"></i>
    </button>
</div>

<!-- Modal التعديل -->
<div class="modal fade" id="editDeductionVariableModal{{ $record->id }}" tabindex="-1"
    aria-labelledby="editDeductionVariableModalLabel{{ $record->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editDeductionVariableModalLabel{{ $record->id }}">تعديل متغير الاستقطاع</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('admin.deduction-variables.update', $record->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="row g-3">
                        <!-- الصف الأول -->
                        <div class="col-md-6">
                            <label class="form-label">الكود <span class="text-danger">*</span></label>
                            <input type="text" name="code" class="form-control" value="{{ $record->code }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">الاسم عربي <span class="text-danger">*</span></label>
                            <input type="text" name="name_ar" class="form-control" value="{{ $record->name_ar }}"
                                required>
                        </div>

                        <!-- الصف الثاني -->
                        <div class="col-md-6">
                            <label class="form-label">الاسم إنجليزي</label>
                            <input type="text" name="name_en" class="form-control" value="{{ $record->name_en }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">رقم الحساب</label>
                            <input type="text" name="account_number" class="form-control"
                                value="{{ $record->account_number }}">
                        </div>

                        <!-- الصف الثالث -->
                        <div class="col-md-4">
                            <label class="form-label">النوع</label>
                            <select name="deduction_category_id" class="form-control">
                                <option value="">اختر النوع</option>
                                @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ $record->deduction_category_id == $category->id ?
                                    'selected' : '' }}>
                                    {{ $category->name_ar }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <!-- بعد حقل الاسم الإنجليزي -->
                        <div class="col-md-4">
                            <label class="form-label">القيمة (سعر)</label>
                            <input type="number" name="value" class="form-control" step="0.01" min="0" value="{{ $record->value }}"
                                placeholder="0.00">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">علاقة الاستحقاق</label>
                            <select name="entitlement_type_relation_id" class="form-control">
                                <option value="">اختر علاقة الاستحقاق</option>
                                @foreach($entitlementRelations as $relation)
                                <option value="{{ $relation->id }}" {{ $record->entitlement_type_relation_id ==
                                    $relation->id ? 'selected' : '' }}>
                                    {{ $relation->code }} - {{ $relation->name_ar }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- الصف الرابع -->
                        <div class="col-md-6">
                            <label class="form-label">كود منظومة الضرائب</label>
                            <input type="text" name="tax_system_code" class="form-control"
                                value="{{ $record->tax_system_code }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">نوع الاستقطاع</label>
                            <select name="deduction_type_id" class="form-control">
                                <option value="">اختر نوع الاستقطاع</option>
                                @foreach($deductionTypes as $type)
                                <option value="{{ $type->id }}" {{ $record->deduction_type_id == $type->id ? 'selected'
                                    : '' }}>
                                    {{ $type->name_ar }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- طبيعة الاستقطاع - Checkboxes -->
                        <div class="col-md-6">
                            <label class="form-label">طبيعة الاستقطاع</label>
                            <div class="mt-2">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="is_fixed"
                                        id="is_fixed_{{ $record->id }}" value="1" {{ $record->is_fixed ? 'checked' : ''
                                    }}>
                                    <label class="form-check-label" for="is_fixed_{{ $record->id }}">ثابت</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="is_monthly"
                                        id="is_monthly_{{ $record->id }}" value="1" {{ $record->is_monthly ? 'checked' :
                                    '' }}>
                                    <label class="form-check-label" for="is_monthly_{{ $record->id }}">شهري</label>
                                </div>
                            </div>
                        </div>

                        <!-- Checkboxes الأخرى -->
                        <div class="col-md-6">
                            <div class="form-check form-switch mt-4">
                                <input class="form-check-input" type="checkbox" name="is_taxable"
                                    id="is_taxable_{{ $record->id }}" value="1" {{ $record->is_taxable ? 'checked' : ''
                                }}>
                                <label class="form-check-label" for="is_taxable_{{ $record->id }}">يخضع للضريبة</label>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-check form-switch mt-2">
                                <input class="form-check-input" type="checkbox" name="affects_bonus"
                                    id="affects_bonus_{{ $record->id }}" value="1" {{ $record->affects_bonus ? 'checked'
                                : '' }}>
                                <label class="form-check-label" for="affects_bonus_{{ $record->id }}">يؤثر على
                                    المكافأة</label>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-check form-switch mt-2">
                                <input class="form-check-input" type="checkbox" name="not_affect_salary"
                                    id="not_affect_salary_{{ $record->id }}" value="1" {{ $record->not_affect_salary ?
                                'checked' : '' }}>
                                <label class="form-check-label" for="not_affect_salary_{{ $record->id }}">لا يؤثر على
                                    المرتب</label>
                            </div>
                        </div>

                        <!-- الحالة -->
                        <div class="col-md-12">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="is_active"
                                    id="is_active_{{ $record->id }}" value="1" {{ $record->is_active ? 'checked' : ''
                                }}>
                                <label class="form-check-label" for="is_active_{{ $record->id }}">نشط</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إلغاء</button>
                    <button type="submit" class="btn btn-primary">تحديث</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal الحذف -->
<div class="modal fade" id="deleteDeductionVariableModal{{ $record->id }}" tabindex="-1"
    aria-labelledby="deleteDeductionVariableModalLabel{{ $record->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteDeductionVariableModalLabel{{ $record->id }}">تأكيد الحذف</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('admin.deduction-variables.destroy', $record->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <div class="modal-body">
                    <p>هل أنت متأكد من حذف متغير الاستقطاع: <strong>{{ $record->name_ar }}</strong>؟</p>
                    <p class="text-danger">هذا الإجراء لا يمكن التراجع عنه.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إلغاء</button>
                    <button type="submit" class="btn btn-danger">حذف</button>
                </div>
            </form>
        </div>
    </div>
</div>
