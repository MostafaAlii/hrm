<div class="tab-pane fade show active" id="employee-qualification" role="tabpanel"
    aria-labelledby="employee-qualifications-tab">
    <div class="mb-2 d-flex justify-content-between">
        <h5 class="mt-2 mb-3 section-title">
            مؤهلات الموظف
            <span>{{ '( ' . $record?->name_ar . ' )' }}</span>
        </h5>
        <!-- زرار إضافة عقد -->
        <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#addQualificationModal">
            <i class="fas fa-plus"></i> إضافة مؤهل
        </button>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="addQualificationModal" tabindex="-1" aria-labelledby="addQualificationModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <form action="{{ route('admin.employee.qualifications.store') }}" method="POST">
                @csrf
                <input type="hidden" name="employee_id" value="{{ $record?->id }}">

                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addQualificationModalLabel">إضافة مؤهل للموظف</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="إغلاق"></button>
                    </div>

                    <div class="modal-body">
                        <div class="mb-3 row">
                            <div class="col-md-6">
                                <label class="form-label">طبيعة المؤهل</label>
                                <select name="qualification_id" class="form-select" required>
                                    <option value="">اختر...</option>
                                    @foreach($qualifications as $qualification)
                                    <option value="{{ $qualification->id }}">{{ $qualification->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">المؤهل</label>
                                <select name="educational_degree_id" class="form-select" required>
                                    <option value="">اختر...</option>
                                    @foreach($educationalDegrees as $degree)
                                    <option value="{{ $degree->id }}">{{ $degree->name_ar }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <div class="col-md-6">
                                <label class="form-label">الكلية / المدرسة</label>
                                <select name="university_id" class="form-select">
                                    <option value="">اختر...</option>
                                    @foreach($universities as $university)
                                    <option value="{{ $university->id }}">{{ $university->name_ar }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">التخصص</label>
                                <select name="specialization_id" class="form-select">
                                    <option value="">اختر...</option>
                                    @foreach($specializations as $specialization)
                                    <option value="{{ $specialization->id }}">{{ $specialization->name_ar }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <div class="col-md-6">
                                <label class="form-label">التقدير</label>
                                <select name="grade_id" class="form-select">
                                    <option value="">اختر...</option>
                                    @foreach($grades as $grade)
                                    <option value="{{ $grade->id }}">{{ $grade->name_ar }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-3">
                                <label class="form-label">سنوات الدراسة</label>
                                <input type="number" name="study_years" class="form-control" min="0">
                            </div>

                            <div class="col-md-3">
                                <label class="form-label">سنة التخرج</label>
                                <input type="number" name="graduation_year" class="form-control" min="1900"
                                    max="{{ date('Y') }}">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">ملاحظات</label>
                            <textarea name="notes" class="form-control" rows="2"></textarea>
                        </div>
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
            <thead>
                <tr>
                    <th>#</th>
                    <th>طبيعة المؤهل</th>
                    <th>المؤهل</th>
                    <th>الكلية / المدرسة</th>
                    <th>التخصص</th>
                    <th>التقدير</th>
                    <th>سنوات الدراسة</th>
                    <th>سنة التخرج</th>
                    <th>ملاحظات</th>
                    <th>الإجراءات</th>
                </tr>
            </thead>
            <tbody>
                @forelse($record?->qualifications as $index => $qualification)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $qualification->qualification?->name ?? '-' }}</td>
                    <td>{{ $qualification->educationalDegree?->name_ar ?? '-' }}</td>
                    <td>{{ $qualification->university?->name_ar ?? '-' }}</td>
                    <td>{{ $qualification->specialization?->name_ar ?? '-' }}</td>
                    <td>{{ $qualification->grade?->name_ar ?? '-' }}</td>
                    <td>{{ $qualification->study_years ?? '-' }}</td>
                    <td>{{ $qualification->graduation_year ?? '-' }}</td>
                    <td>{{ $qualification->notes ?? '-' }}</td>
                    <td>
                        <button class="btn btn-primary btn-sm" data-bs-toggle="modal"
                            data-bs-target="#editQualificationModal{{ $qualification->id }}">
                            <i class="fas fa-edit"></i>
                        </button>
                        <!-- زرار الحذف -->
                        <button class="btn btn-danger btn-sm" data-bs-toggle="modal"
                            data-bs-target="#deleteQualificationModal{{ $qualification->id }}">
                            <i class="fas fa-trash"></i>
                        </button>

                        <!-- Delete Modal -->
                        <div class="modal fade" id="deleteQualificationModal{{ $qualification->id }}" tabindex="-1"
                            aria-labelledby="deleteQualificationModalLabel{{ $qualification->id }}" aria-hidden="true">
                            <div class="modal-dialog">
                                <form action="{{ route('admin.employee.qualifications.destroy', $qualification->id) }}"
                                    method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title"
                                                id="deleteQualificationModalLabel{{ $qualification->id }}">
                                                تأكيد الحذف
                                            </h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="إغلاق"></button>
                                        </div>
                                        <div class="modal-body">
                                            هل أنت متأكد من حذف هذا <span class="text-danger">{{$qualification?->educationalDegree?->name_ar}}</span> للموظف
                                            <strong>{{ $record?->name_ar }}</strong>؟
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">إلغاء</button>
                                            <button type="submit" class="btn btn-danger">حذف</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- End Delete Modal -->

                        <!-- Edit Modal -->
                        <div class="modal fade" id="editQualificationModal{{ $qualification->id }}" tabindex="-1"
                            aria-labelledby="editQualificationModalLabel{{ $qualification->id }}" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <form action="{{ route('admin.employee.qualifications.update', $qualification->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="employee_id" value="{{ $record?->id }}">

                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editQualificationModalLabel{{ $qualification->id }}">
                                                تعديل مؤهل الموظف
                                            </h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="إغلاق"></button>
                                        </div>

                                        <div class="modal-body">
                                            <div class="mb-3 row">
                                                <div class="col-md-6">
                                                    <label class="form-label">طبيعة المؤهل</label>
                                                    <select name="qualification_id" class="form-select" required>
                                                        <option value="">اختر...</option>
                                                        @foreach($qualifications as $item)
                                                        <option value="{{ $item->id }}" {{ $qualification->qualification_id == $item->id ?
                                                            'selected' : '' }}>
                                                            {{ $item->name }}
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="col-md-6">
                                                    <label class="form-label">المؤهل</label>
                                                    <select name="educational_degree_id" class="form-select" required>
                                                        <option value="">اختر...</option>
                                                        @foreach($educationalDegrees as $degree)
                                                        <option value="{{ $degree->id }}" {{ $qualification->educational_degree_id ==
                                                            $degree->id ? 'selected' : '' }}>
                                                            {{ $degree->name_ar }}
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="mb-3 row">
                                                <div class="col-md-6">
                                                    <label class="form-label">الكلية / المدرسة</label>
                                                    <select name="university_id" class="form-select">
                                                        <option value="">اختر...</option>
                                                        @foreach($universities as $university)
                                                        <option value="{{ $university->id }}" {{ $qualification->university_id ==
                                                            $university->id ? 'selected' : '' }}>
                                                            {{ $university->name_ar }}
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="col-md-6">
                                                    <label class="form-label">التخصص</label>
                                                    <select name="specialization_id" class="form-select">
                                                        <option value="">اختر...</option>
                                                        @foreach($specializations as $specialization)
                                                        <option value="{{ $specialization->id }}" {{ $qualification->specialization_id ==
                                                            $specialization->id ? 'selected' : '' }}>
                                                            {{ $specialization->name_ar }}
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="mb-3 row">
                                                <div class="col-md-6">
                                                    <label class="form-label">التقدير</label>
                                                    <select name="grade_id" class="form-select">
                                                        <option value="">اختر...</option>
                                                        @foreach($grades as $grade)
                                                        <option value="{{ $grade->id }}" {{ $qualification->grade_id == $grade->id ? 'selected'
                                                            : '' }}>
                                                            {{ $grade->name_ar }}
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="col-md-3">
                                                    <label class="form-label">سنوات الدراسة</label>
                                                    <input type="number" name="study_years" class="form-control"
                                                        value="{{ $qualification->study_years }}" min="0">
                                                </div>

                                                <div class="col-md-3">
                                                    <label class="form-label">سنة التخرج</label>
                                                    <input type="number" name="graduation_year" class="form-control"
                                                        value="{{ $qualification->graduation_year }}" min="1900" max="{{ date('Y') }}">
                                                </div>
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label">ملاحظات</label>
                                                <textarea name="notes" class="form-control" rows="2">{{ $qualification->notes }}</textarea>
                                            </div>
                                        </div>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إلغاء</button>
                                            <button type="submit" class="btn btn-primary">تعديل</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- End Edit Modal -->
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="10" class="text-center text-muted">لا يوجد مؤهلات مضافة</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <!-- End Table -->
</div>
