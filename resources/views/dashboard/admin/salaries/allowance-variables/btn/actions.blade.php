{{-- resources/views/dashboard/admin/settings/allowance-variables/btn/actions.blade.php --}}
<div class="btn-group">
    <!-- زر التعديل -->
    <button type="button" class="btn btn-sm btn-warning" data-bs-toggle="modal"
        data-bs-target="#editAllowanceVariableModal{{ $record->id }}">
        <i class="fa fa-edit"></i>
    </button>

    <!-- زر الحذف -->
    <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal"
        data-bs-target="#deleteAllowanceVariableModal{{ $record->id }}">
        <i class="fa fa-trash"></i>
    </button>
</div>

<!-- Modal التعديل -->
<div class="modal fade" id="editAllowanceVariableModal{{ $record->id }}" tabindex="-1"
    aria-labelledby="editAllowanceVariableModalLabel{{ $record->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editAllowanceVariableModalLabel{{ $record->id }}">تعديل متغير العلاوة</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('admin.allowance-variables.update', $record->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">الكود <span class="text-danger">*</span></label>
                            <input type="text" name="code" class="form-control" value="{{ $record->code }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">الوصف عربي <span class="text-danger">*</span></label>
                            <input type="text" name="name_ar" class="form-control" value="{{ $record->name_ar }}"
                                required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">الوصف إنجليزي</label>
                            <input type="text" name="name_en" class="form-control" value="{{ $record->name_en }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">رقم الحساب</label>
                            <input type="text" name="account_number" class="form-control"
                                value="{{ $record->account_number }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">النوع</label>
                            <select name="allowance_category_id" class="form-control">
                                <option value="">اختر النوع</option>
                                @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ $record->allowance_category_id == $category->id ?
                                    'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">قيمة النوع</label>
                            <input type="text" name="category_value" class="form-control"
                                value="{{ $record->category_value }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">علاقة الاستحقاق</label>
                            <select name="entitlement_type_relation_id" class="form-control">
                                <option value="">اختر علاقة الاستحقاق</option>
                                @foreach($entitlementRelations as $relation)
                                <option value="{{ $relation->id }}" {{ $record->entitlement_type_relation_id == $relation->id ? 'selected' : ''
                                    }}>
                                    {{ $relation->code }} - {{ $relation->name_ar }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">كود منظومة الضرائب</label>
                            <input type="text" name="tax_system_code" class="form-control"
                                value="{{ $record->tax_system_code }}">
                        </div>

                        <!-- Checkboxes -->
                        <div class="col-md-3">
                            <div class="mt-4 form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="has_min_limit"
                                    id="has_min_limit_{{ $record->id }}" value="1" {{ $record->has_min_limit ? 'checked'
                                : '' }}>
                                <label class="form-check-label" for="has_min_limit_{{ $record->id }}">الحد
                                    الأدنى</label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mt-4 form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="has_max_limit"
                                    id="has_max_limit_{{ $record->id }}" value="1" {{ $record->has_max_limit ? 'checked'
                                : '' }}>
                                <label class="form-check-label" for="has_max_limit_{{ $record->id }}">الحد
                                    الأقصى</label>
                            </div>
                        </div>

                        <!-- حقول قيم الحدود -->
                        <div class="col-md-6 min-limit-field"
                            style="{{ $record->has_min_limit ? '' : 'display: none;' }}">
                            <label class="form-label">قيمة الحد الأدنى</label>
                            <input type="number" name="min_limit_value" class="form-control" step="0.01"
                                value="{{ $record->min_limit_value }}" placeholder="أدخل قيمة الحد الأدنى">
                        </div>
                        <div class="col-md-6 max-limit-field"
                            style="{{ $record->has_max_limit ? '' : 'display: none;' }}">
                            <label class="form-label">قيمة الحد الأقصى</label>
                            <input type="number" name="max_limit_value" class="form-control" step="0.01"
                                value="{{ $record->max_limit_value }}" placeholder="أدخل قيمة الحد الأقصى">
                        </div>

                        <div class="col-md-3">
                            <div class="mt-4 form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="is_taxable"
                                    id="is_taxable_{{ $record->id }}" value="1" {{ $record->is_taxable ? 'checked' : ''
                                }}>
                                <label class="form-check-label" for="is_taxable_{{ $record->id }}">يخضع للضريبة</label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mt-4 form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="is_health_insurance"
                                    id="is_health_insurance_{{ $record->id }}" value="1" {{ $record->is_health_insurance
                                ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_health_insurance_{{ $record->id }}">يخضع للتأمين
                                    الصحي</label>
                            </div>
                        </div>

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
<div class="modal fade" id="deleteAllowanceVariableModal{{ $record->id }}" tabindex="-1"
    aria-labelledby="deleteAllowanceVariableModalLabel{{ $record->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteAllowanceVariableModalLabel{{ $record->id }}">تأكيد الحذف</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('admin.allowance-variables.destroy', $record->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <div class="modal-body">
                    <p>هل أنت متأكد من حذف متغير العلاوة: <strong>{{ $record->name_ar }}</strong>؟</p>
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
