<div class="tab-pane fade" id="employee-experiences" role="tabpanel" aria-labelledby="employee-experiences-tab">
    <div class="mb-2 d-flex justify-content-between">
        <h5 class="mt-2 mb-3 section-title">
            الخبرات السابقة
            <span>{{ '( ' . $record?->name_ar . ' )' }}</span>
        </h5>
        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#createExperienceModal">
            <i class="fa fa-plus"></i> إضافة
        </button>
    </div>

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>الخبرة</th>
                <th>من تاريخ</th>
                <th>إلى تاريخ</th>
                <th>مدة الخبرة</th>
                <th>تليفون العمل السابق</th>
                <th>عنوان العمل السابق</th>
                <th>ملاحظات</th>
                <th>الإجراءات</th>
            </tr>
        </thead>
        <tbody>
            @forelse($experiences ?? [] as $experience)
            <tr>
                <td>{{ $experience->experience }}</td>
                <td>{{ $experience->from_date ? \Carbon\Carbon::parse($experience->from_date)->format('Y-m-d') : '-' }}
                </td>
                <td>{{ $experience->to_date ? \Carbon\Carbon::parse($experience->to_date)->format('Y-m-d') : '-' }}</td>
                <td>{{ $experience->experience_duration }}</td>
                <td>{{ $experience->previous_work_phone ?? '-' }}</td>
                <td>{{ $experience->previous_work_address ?? '-' }}</td>
                <td>{{ $experience->notes ?? '-' }}</td>
                <td>
                    <div class="btn-group">
                        <button type="button" class="btn btn-sm btn-warning" data-bs-toggle="modal"
                            data-bs-target="#editExperienceModal{{ $experience->id }}">
                            <i class="fa fa-edit"></i>
                        </button>
                        <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal"
                            data-bs-target="#deleteExperienceModal{{ $experience->id }}">
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
    <div class="modal fade" id="createExperienceModal" tabindex="-1" aria-labelledby="createExperienceModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <form action="{{ route('admin.employee.experiences.store', $record->id) }}" method="POST">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="createExperienceModalLabel">إضافة خبرة</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="إغلاق"></button>
                    </div>
                    <div class="modal-body row g-3">
                        <div class="col-md-12">
                            <label class="form-label">الخبرة / الوظيفة السابقة <span
                                    class="text-danger">*</span></label>
                            <input type="text" name="experience" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">من تاريخ <span class="text-danger">*</span></label>
                            <input type="date" name="from_date" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">إلى تاريخ <span class="text-danger">*</span></label>
                            <input type="date" name="to_date" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">تليفون العمل السابق</label>
                            <input type="text" name="previous_work_phone" class="form-control">
                        </div>
                        <div class="col-md-12">
                            <label class="form-label">عنوان العمل السابق</label>
                            <textarea name="previous_work_address" class="form-control" rows="2"></textarea>
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

    <!-- Modals التعديل والحذف لكل خبرة -->
    @foreach($experiences ?? [] as $experience)
    <!-- Modal التعديل -->
    <div class="modal fade" id="editExperienceModal{{ $experience->id }}" tabindex="-1"
        aria-labelledby="editExperienceModalLabel{{ $experience->id }}" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <form
                action="{{ route('admin.employee.experiences.update', ['employee' => $record->id, 'experience' => $experience->id]) }}"
                method="POST">
                @csrf
                @method('PUT')
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editExperienceModalLabel{{ $experience->id }}">تعديل الخبرة</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="إغلاق"></button>
                    </div>
                    <div class="modal-body row g-3">
                        <div class="col-md-12">
                            <label class="form-label">الخبرة / الوظيفة السابقة <span
                                    class="text-danger">*</span></label>
                            <input type="text" name="experience" class="form-control"
                                value="{{ $experience->experience }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">من تاريخ <span class="text-danger">*</span></label>
                            <input type="date" name="from_date" class="form-control"
                                value="{{ $experience->from_date ? \Carbon\Carbon::parse($experience->from_date)->format('Y-m-d') : '' }}"
                                required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">إلى تاريخ <span class="text-danger">*</span></label>
                            <input type="date" name="to_date" class="form-control"
                                value="{{ $experience->to_date ? \Carbon\Carbon::parse($experience->to_date)->format('Y-m-d') : '' }}"
                                required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">تليفون العمل السابق</label>
                            <input type="text" name="previous_work_phone" class="form-control"
                                value="{{ $experience->previous_work_phone }}">
                        </div>
                        <div class="col-md-12">
                            <label class="form-label">عنوان العمل السابق</label>
                            <textarea name="previous_work_address" class="form-control"
                                rows="2">{{ $experience->previous_work_address }}</textarea>
                        </div>
                        <div class="col-md-12">
                            <label class="form-label">ملاحظات</label>
                            <textarea name="notes" class="form-control" rows="3">{{ $experience->notes }}</textarea>
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
    <div class="modal fade" id="deleteExperienceModal{{ $experience->id }}" tabindex="-1"
        aria-labelledby="deleteExperienceModalLabel{{ $experience->id }}" aria-hidden="true">
        <div class="modal-dialog">
            <form
                action="{{ route('admin.employee.experiences.destroy', ['employee' => $record->id, 'experience' => $experience->id]) }}"
                method="POST">
                @csrf
                @method('DELETE')
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteExperienceModalLabel{{ $experience->id }}">تأكيد الحذف</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="إغلاق"></button>
                    </div>
                    <div class="modal-body">
                        <p>هل أنت متأكد من حذف الخبرة: <strong>{{ $experience->experience }}</strong>؟</p>
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
