<div class="tab-pane fade" id="employee-trainings" role="tabpanel" aria-labelledby="employee-trainings-tab">
    <div class="mb-2 d-flex justify-content-between">
        <h5 class="mt-2 mb-3 section-title">
            الدورات التدريبية
            <span>{{ '( ' . $record?->name_ar . ' )' }}</span>
        </h5>
        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#createTrainingModal">
            <i class="fa fa-plus"></i> إضافة
        </button>
    </div>

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>اسم الدورة</th>
                <th>مكان التدريب</th>
                <th>من تاريخ</th>
                <th>إلى تاريخ</th>
                <th>عدد الساعات</th>
                <th>التقدير</th>
                <th>ملاحظات</th>
                <th>الإجراءات</th>
            </tr>
        </thead>
        <tbody>
            @forelse($trainings ?? [] as $training)
            <tr>
                <td>{{ $training->name }}</td>
                <td>{{ $training->training_place }}</td>
                <td>{{ $training->from_date ? \Carbon\Carbon::parse($training->from_date)->format('Y-m-d') : '-' }}</td>
                <td>{{ $training->to_date ? \Carbon\Carbon::parse($training->to_date)->format('Y-m-d') : '-' }}</td>
                <td>{{ $training->hours }}</td>
                <td>{{ $training->grade?->name_ar ?? '-' }}</td>
                <td>{{ $training->notes ?? '-' }}</td>
                <td>
                    <div class="btn-group">
                        <button type="button" class="btn btn-sm btn-warning" data-bs-toggle="modal"
                            data-bs-target="#editTrainingModal{{ $training->id }}">
                            <i class="fa fa-edit"></i>
                        </button>
                        <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal"
                            data-bs-target="#deleteTrainingModal{{ $training->id }}">
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
    <div class="modal fade" id="createTrainingModal" tabindex="-1" aria-labelledby="createTrainingModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <form action="{{ route('admin.employee.trainings.store', $record->id) }}" method="POST">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="createTrainingModalLabel">إضافة دورة تدريبية</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="إغلاق"></button>
                    </div>
                    <div class="modal-body row g-3">
                        <div class="col-md-6">
                            <label class="form-label">اسم الدورة <span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">مكان التدريب <span class="text-danger">*</span></label>
                            <input type="text" name="training_place" class="form-control" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">من تاريخ <span class="text-danger">*</span></label>
                            <input type="date" name="from_date" class="form-control" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">إلى تاريخ <span class="text-danger">*</span></label>
                            <input type="date" name="to_date" class="form-control" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">عدد الساعات <span class="text-danger">*</span></label>
                            <input type="number" name="hours" class="form-control" min="1" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">التقدير</label>
                            <select name="grade_id" class="form-select">
                                <option value="">-- اختر --</option>
                                @foreach($grades ?? [] as $grade)
                                <option value="{{ $grade->id }}">{{ $grade->name_ar }}</option>
                                @endforeach
                            </select>
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

    <!-- Modals التعديل والحذف لكل دورة تدريبية -->
    @foreach($trainings ?? [] as $training)
    <!-- Modal التعديل -->
    <div class="modal fade" id="editTrainingModal{{ $training->id }}" tabindex="-1"
        aria-labelledby="editTrainingModalLabel{{ $training->id }}" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <form
                action="{{ route('admin.employee.trainings.update', ['employee' => $record->id, 'training' => $training->id]) }}"
                method="POST">
                @csrf
                @method('PUT')
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editTrainingModalLabel{{ $training->id }}">تعديل الدورة التدريبية
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="إغلاق"></button>
                    </div>
                    <div class="modal-body row g-3">
                        <div class="col-md-6">
                            <label class="form-label">اسم الدورة <span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control" value="{{ $training->name }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">مكان التدريب <span class="text-danger">*</span></label>
                            <input type="text" name="training_place" class="form-control"
                                value="{{ $training->training_place }}" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">من تاريخ <span class="text-danger">*</span></label>
                            <input type="date" name="from_date" class="form-control"
                                value="{{ $training->from_date ? \Carbon\Carbon::parse($training->from_date)->format('Y-m-d') : '' }}"
                                required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">إلى تاريخ <span class="text-danger">*</span></label>
                            <input type="date" name="to_date" class="form-control"
                                value="{{ $training->to_date ? \Carbon\Carbon::parse($training->to_date)->format('Y-m-d') : '' }}"
                                required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">عدد الساعات <span class="text-danger">*</span></label>
                            <input type="number" name="hours" class="form-control" value="{{ $training->hours }}"
                                min="1" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">التقدير</label>
                            <select name="grade_id" class="form-select">
                                <option value="">-- اختر --</option>
                                @foreach($grades ?? [] as $grade)
                                <option value="{{ $grade->id }}" {{ $training->grade_id == $grade->id ? 'selected' : ''
                                    }}>
                                    {{ $grade->name_ar }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-12">
                            <label class="form-label">ملاحظات</label>
                            <textarea name="notes" class="form-control" rows="3">{{ $training->notes }}</textarea>
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
    <div class="modal fade" id="deleteTrainingModal{{ $training->id }}" tabindex="-1"
        aria-labelledby="deleteTrainingModalLabel{{ $training->id }}" aria-hidden="true">
        <div class="modal-dialog">
            <form
                action="{{ route('admin.employee.trainings.destroy', ['employee' => $record->id, 'training' => $training->id]) }}"
                method="POST">
                @csrf
                @method('DELETE')
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteTrainingModalLabel{{ $training->id }}">تأكيد الحذف</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="إغلاق"></button>
                    </div>
                    <div class="modal-body">
                        <p>هل أنت متأكد من حذف الدورة التدريبية: <strong>{{ $training->name }}</strong>؟</p>
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
