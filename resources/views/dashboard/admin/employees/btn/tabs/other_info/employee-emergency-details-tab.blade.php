{{--<div class="tab-pane fade show active" id="employee-emergency" role="tabpanel"
    aria-labelledby="employee-emergency-tab">
    <div class="mb-2 d-flex justify-content-between">
        <h5 class="mt-2 mb-3 section-title">
            عند الطوارى
            <span>{{ '( ' . $record?->name_ar . ' )' }}</span>
        </h5>
        <!-- زرار إضافة عقد -->
        <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#addEmergencyModal">
            <i class="fas fa-plus"></i> إضافة
        </button>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="addEmergencyModal" tabindex="-1" aria-labelledby="addEmergencyModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <form action="{{ route('admin.employee.emergency.store') }}" method="POST">
                @csrf
                <input type="hidden" name="employee_id" value="{{ $record?->id }}">

                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addQualificationModalLabel">إضافة طوارى</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="إغلاق"></button>
                    </div>

                    <div class="modal-body">

                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إلغاء</button>
                        <button type="submit" class="btn btn-success">إضافة</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- Start Table -->
    <div class="table-responsive">
        <table class="table table-bordered table-striped">

        </table>
    </div>
    <!-- End Table -->
</div>--}}

<div class="tab-pane fade" id="employee-emergency-details" role="tabpanel" aria-labelledby="employee-emergency-tab">
    <div class="mb-2 d-flex justify-content-between">
        <h5 class="mt-2 mb-3 section-title">
            جهات الاتصال للطوارئ
            <span>{{ '( ' . $record?->name_ar . ' )' }}</span>
        </h5>
        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#createEmergencyModal">
            <i class="fa fa-plus"></i> إضافة
        </button>
    </div>

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>الاسم (عربي)</th>
                <th>الاسم (إنجليزي)</th>
                <th>درجة القرابة</th>
                <th>التليفون</th>
                <th>الموبايل</th>
                <th>البريد الإلكتروني</th>
                <th>الإجراءات</th>
            </tr>
        </thead>
        <tbody>
            @forelse($emergencyContacts ?? [] as $contact)
            <tr>
                <td>{{ $contact->name_ar }}</td>
                <td>{{ $contact->name_en ?? '-' }}</td>
                <td>{{ $contact->relativeDegree?->name_ar ?? '-' }}</td>
                <td>{{ $contact->phone ?? '-' }}</td>
                <td>{{ $contact->mobile ?? '-' }}</td>
                <td>{{ $contact->email ?? '-' }}</td>
                <td>
                    <div class="btn-group">
                        <button type="button" class="btn btn-sm btn-warning" data-bs-toggle="modal"
                            data-bs-target="#editEmergencyModal{{ $contact->id }}">
                            <i class="fa fa-edit"></i>
                        </button>
                        <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal"
                            data-bs-target="#deleteEmergencyModal{{ $contact->id }}">
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
    <div class="modal fade" id="createEmergencyModal" tabindex="-1" aria-labelledby="createEmergencyModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <form action="{{ route('admin.employee.emergencies.store', $record->id) }}" method="POST">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="createEmergencyModalLabel">إضافة جهة اتصال للطوارئ</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="إغلاق"></button>
                    </div>
                    <div class="modal-body row g-3">
                        <div class="col-md-6">
                            <label class="form-label">الاسم (عربي) <span class="text-danger">*</span></label>
                            <input type="text" name="name_ar" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">الاسم (إنجليزي)</label>
                            <input type="text" name="name_en" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">درجة القرابة</label>
                            <select name="relative_degree_id" class="form-select">
                                <option value="">-- اختر --</option>
                                @foreach($relativeDegrees ?? [] as $degree)
                                <option value="{{ $degree->id }}">{{ $degree->name_ar }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">التليفون</label>
                            <input type="text" name="phone" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">الموبايل</label>
                            <input type="text" name="mobile" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">البريد الإلكتروني</label>
                            <input type="email" name="email" class="form-control">
                        </div>
                        <div class="col-md-12">
                            <label class="form-label">العنوان <span class="text-danger">*</span></label>
                            <input type="text" name="address" class="form-control">
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

    <!-- Modals التعديل والحذف لكل جهة اتصال -->
    @foreach($emergencyContacts ?? [] as $contact)
    <!-- Modal التعديل -->
    <div class="modal fade" id="editEmergencyModal{{ $contact->id }}" tabindex="-1"
        aria-labelledby="editEmergencyModalLabel{{ $contact->id }}" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <form
                action="{{ route('admin.employee.emergencies.update', ['employee' => $record->id, 'emergency' => $contact->id]) }}"
                method="POST">
                @csrf
                @method('PUT')
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editEmergencyModalLabel{{ $contact->id }}">تعديل جهة الاتصال</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="إغلاق"></button>
                    </div>
                    <div class="modal-body row g-3">
                        <div class="col-md-6">
                            <label class="form-label">الاسم (عربي) <span class="text-danger">*</span></label>
                            <input type="text" name="name_ar" class="form-control" value="{{ $contact->name_ar }}"
                                required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">الاسم (إنجليزي)</label>
                            <input type="text" name="name_en" class="form-control" value="{{ $contact->name_en }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">درجة القرابة</label>
                            <select name="relative_degree_id" class="form-select">
                                <option value="">-- اختر --</option>
                                @foreach($relativeDegrees ?? [] as $degree)
                                <option value="{{ $degree->id }}" {{ $contact->relative_degree_id == $degree->id ?
                                    'selected' : '' }}>
                                    {{ $degree->name_ar }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">التليفون</label>
                            <input type="text" name="phone" class="form-control" value="{{ $contact->phone }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">الموبايل</label>
                            <input type="text" name="mobile" class="form-control" value="{{ $contact->mobile }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">البريد الإلكتروني</label>
                            <input type="email" name="email" class="form-control" value="{{ $contact->email }}">
                        </div>
                        <div class="col-md-12">
                            <label class="form-label">العنوان <span class="text-danger">*</span></label>
                            <input type="text" name="address" class="form-control" value="{{ $contact->address }}">
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
    <div class="modal fade" id="deleteEmergencyModal{{ $contact->id }}" tabindex="-1"
        aria-labelledby="deleteEmergencyModalLabel{{ $contact->id }}" aria-hidden="true">
        <div class="modal-dialog">
            <form
                action="{{ route('admin.employee.emergencies.destroy', ['employee' => $record->id, 'emergency' => $contact->id]) }}"
                method="POST">
                @csrf
                @method('DELETE')
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteEmergencyModalLabel{{ $contact->id }}">تأكيد الحذف</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="إغلاق"></button>
                    </div>
                    <div class="modal-body">
                        <p>هل أنت متأكد من حذف جهة الاتصال: <strong>{{ $contact->name_ar }}</strong>؟</p>
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
