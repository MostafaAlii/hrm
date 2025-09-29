{{--<div class="tab-pane fade" id="employee-family-details" role="tabpanel" aria-labelledby="employee-family-details-tab">
    <div class="mb-2 d-flex justify-content-between">
        <h5 class="mt-2 mb-3 section-title">
            عوائل الموظف
            <span>{{ '( ' . $record?->name_ar . ' )' }}</span>
        </h5>
        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#createFamilyModal">
            <i class="fa fa-plus"></i> إضافة
        </button>
    </div>

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>الاسم (عربي)</th>
                <th>صلة القرابة</th>
                <th>النوع</th>
                <th>الحالة الوظيفية</th>
                <th>الوظيفة</th>
                <th>تاريخ الميلاد</th>
                <th>التأمين الصحي الشامل</th>
            </tr>
        </thead>
        <tbody>
            @forelse($families ?? [] as $family)
            <tr>
                <td>{{ $family->name_ar }}</td>
                <td>{{ $family->relativeDegree?->name_ar }}</td>
                <td>{{ $family->gender === 'male' ? 'ذكر' : 'أنثى' }}</td>
                <td>{{ $family->is_working ? 'يعمل' : 'لا يعمل' }}</td>
                <td>{{ $family->familyJob?->name_ar }}</td>
                <td>{{ $family->birth_date ? \Carbon\Carbon::parse($family->birth_date)->format('Y-m-d') : '-' }}</td>
                <td>
                    {!! $family->subject_to_health_insurance
                    ? '<i class="fa fa-check text-success"></i> يخضع'
                    : '<i class="fa fa-times text-danger"></i> لا يخضع' !!}
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" class="text-center">لا توجد بيانات</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div class="modal fade" id="createFamilyModal" tabindex="-1" aria-labelledby="createFamilyModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <form action="{{ route('admin.employee.families.store', $record->id) }}" method="POST">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="createFamilyModalLabel">إضافة فرد عائلة</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="إغلاق"></button>
                    </div>
                    <div class="modal-body row g-3">
                        <div class="col-md-6">
                            <label class="form-label">الاسم (عربي)</label>
                            <input type="text" name="name_ar" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">صلة القرابة</label>
                            <select name="relative_degree_id" class="form-select" required>
                                <option value="">-- اختر --</option>
                                @foreach($relativeDegrees ?? [] as $degree)
                                <option value="{{ $degree->id }}">{{ $degree->name_ar }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">النوع</label>
                            <select name="gender" class="form-select" required>
                                <option value="male">ذكر</option>
                                <option value="female">أنثى</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">الحالة الوظيفية</label>
                            <select name="is_working" class="form-select">
                                <option value="1">يعمل / تعمل</option>
                                <option value="0">لا يعمل / لا تعمل</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">الوظيفة</label>
                            <select name="family_job_id" class="form-select">
                                <option value="">-- اختر --</option>
                                @foreach($familyJobs ?? [] as $job)
                                <option value="{{ $job->id }}">{{ $job->name_ar }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label class="form-label">ID</label>
                                <input type="text" name="identity_number" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">تاريخ الميلاد</label>
                                <input type="date" name="birth_date" class="form-control">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">التأمين الصحي الشامل</label>
                            <select name="subject_to_health_insurance" class="form-select">
                                <option value="1">نعم</option>
                                <option value="0">لا</option>
                            </select>
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
</div>--}}
<div class="tab-pane fade" id="employee-family-details" role="tabpanel" aria-labelledby="employee-family-details-tab">
    <div class="mb-2 d-flex justify-content-between">
        <h5 class="mt-2 mb-3 section-title">
            عوائل الموظف
            <span>{{ '( ' . $record?->name_ar . ' )' }}</span>
        </h5>
        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#createFamilyModal">
            <i class="fa fa-plus"></i> إضافة
        </button>
    </div>

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>الاسم (عربي)</th>
                <th>صلة القرابة</th>
                <th>النوع</th>
                <th>الحالة الوظيفية</th>
                <th>الوظيفة</th>
                <th>تاريخ الميلاد</th>
                <th>التأمين الصحي الشامل</th>
                <th>الإجراءات</th>
            </tr>
        </thead>
        <tbody>
            @forelse($families ?? [] as $family)
            <tr>
                <td>{{ $family->name_ar }}</td>
                <td>{{ $family->relativeDegree?->name_ar }}</td>
                <td>{{ $family->gender === 'male' ? 'ذكر' : 'أنثى' }}</td>
                <td>{{ $family->is_working ? 'يعمل' : 'لا يعمل' }}</td>
                <td>{{ $family->familyJob?->name_ar }}</td>
                <td>{{ $family->birth_date ? \Carbon\Carbon::parse($family->birth_date)->format('Y-m-d') : '-' }}</td>
                <td>
                    {!! $family->subject_to_health_insurance
                    ? '<i class="fa fa-check text-success"></i> يخضع'
                    : '<i class="fa fa-times text-danger"></i> لا يخضع' !!}
                </td>
                <td>
                    <div class="btn-group">
                        <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal"
                            data-bs-target="#editFamilyModal{{ $family->id }}">
                            <i class="fa fa-edit"></i>
                        </button>
                        <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal"
                            data-bs-target="#deleteFamilyModal{{ $family->id }}">
                            <i class="fa fa-trash"></i>
                        </button>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="8" class="text-center">لا توجد بيانات</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <!-- Modal الإضافة -->
    <div class="modal fade" id="createFamilyModal" tabindex="-1" aria-labelledby="createFamilyModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <form action="{{ route('admin.employee.families.store', $record->id) }}" method="POST">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="createFamilyModalLabel">إضافة فرد عائلة</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="إغلاق"></button>
                    </div>
                    <div class="modal-body row g-3">
                        <div class="col-md-6">
                            <label class="form-label">الاسم (عربي)</label>
                            <input type="text" name="name_ar" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">صلة القرابة</label>
                            <select name="relative_degree_id" class="form-select" required>
                                <option value="">-- اختر --</option>
                                @foreach($relativeDegrees ?? [] as $degree)
                                <option value="{{ $degree->id }}">{{ $degree->name_ar }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">النوع</label>
                            <select name="gender" class="form-select" required>
                                <option value="male">ذكر</option>
                                <option value="female">أنثى</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">الحالة الوظيفية</label>
                            <select name="is_working" class="form-select">
                                <option value="1">يعمل / تعمل</option>
                                <option value="0">لا يعمل / لا تعمل</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">الوظيفة</label>
                            <select name="family_job_id" class="form-select">
                                <option value="">-- اختر --</option>
                                @foreach($familyJobs ?? [] as $job)
                                <option value="{{ $job->id }}">{{ $job->name_ar }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label class="form-label">ID</label>
                                <input type="text" name="identity_number" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">تاريخ الميلاد</label>
                                <input type="date" name="birth_date" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">التأمين الصحي الشامل</label>
                            <select name="subject_to_health_insurance" class="form-select">
                                <option value="1">نعم</option>
                                <option value="0">لا</option>
                            </select>
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

    <!-- Modals التعديل والحذف لكل عائلة -->
    @foreach($families ?? [] as $family)
    <!-- Modal التعديل -->
    <div class="modal fade" id="editFamilyModal{{ $family->id }}" tabindex="-1"
        aria-labelledby="editFamilyModalLabel{{ $family->id }}" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <form action="{{ route('admin.employee.families.update', ['employee' => $record->id, 'family' => $family->id]) }}"
                method="POST">
                @csrf
                @method('PUT')
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editFamilyModalLabel{{ $family->id }}">تعديل بيانات العائلة</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="إغلاق"></button>
                    </div>
                    <div class="modal-body row g-3">
                        <div class="col-md-6">
                            <label class="form-label">الاسم (عربي)</label>
                            <input type="text" name="name_ar" class="form-control" value="{{ $family->name_ar }}"
                                required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">صلة القرابة</label>
                            <select name="relative_degree_id" class="form-select" required>
                                <option value="">-- اختر --</option>
                                @foreach($relativeDegrees ?? [] as $degree)
                                <option value="{{ $degree->id }}" {{ $family->relative_degree_id == $degree->id ?
                                    'selected' : '' }}>
                                    {{ $degree->name_ar }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">النوع</label>
                            <select name="gender" class="form-select" required>
                                <option value="male" {{ $family->gender == 'male' ? 'selected' : '' }}>ذكر</option>
                                <option value="female" {{ $family->gender == 'female' ? 'selected' : '' }}>أنثى</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">الحالة الوظيفية</label>
                            <select name="is_working" class="form-select">
                                <option value="1" {{ $family->is_working ? 'selected' : '' }}>يعمل / تعمل</option>
                                <option value="0" {{ !$family->is_working ? 'selected' : '' }}>لا يعمل / لا تعمل
                                </option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">الوظيفة</label>
                            <select name="family_job_id" class="form-select">
                                <option value="">-- اختر --</option>
                                @foreach($familyJobs ?? [] as $job)
                                <option value="{{ $job->id }}" {{ $family->family_job_id == $job->id ? 'selected' : ''
                                    }}>
                                    {{ $job->name_ar }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label class="form-label">ID</label>
                                <input type="text" name="identity_number" class="form-control"
                                    value="{{ $family->identity_number }}">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">تاريخ الميلاد</label>
                                <input type="date" name="birth_date" class="form-control"
                                    value="{{ $family->birth_date ? \Carbon\Carbon::parse($family->birth_date)->format('Y-m-d') : '' }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">التأمين الصحي الشامل</label>
                            <select name="subject_to_health_insurance" class="form-select">
                                <option value="1" {{ $family->subject_to_health_insurance ? 'selected' : '' }}>نعم
                                </option>
                                <option value="0" {{ !$family->subject_to_health_insurance ? 'selected' : '' }}>لا
                                </option>
                            </select>
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
    <div class="modal fade" id="deleteFamilyModal{{ $family->id }}" tabindex="-1"
        aria-labelledby="deleteFamilyModalLabel{{ $family->id }}" aria-hidden="true">
        <div class="modal-dialog">
            <form
                action="{{ route('admin.employee.families.destroy', ['employee' => $record->id, 'family' => $family->id]) }}"
                method="POST">
                @csrf
                @method('DELETE')
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteFamilyModalLabel{{ $family->id }}">تأكيد الحذف</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="إغلاق"></button>
                    </div>
                    <div class="modal-body">
                        <p>هل أنت متأكد من حذف العائلة: <strong>{{ $family->name_ar }}</strong>؟</p>
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
