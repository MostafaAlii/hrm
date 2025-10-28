<div class="tab-pane fade show active" id="basic" role="tabpanel" aria-labelledby="basic-tab">
    <form action="{{ route('admin.employee.update', $record->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- البيانات الاساسية -->
        <h5 class="mb-3 mt-2 section-title">البيانات الأساسية</h5>
        <div class="row">
            <!-- يمين -->
            <div class="col-md-6">
                <div class="row">
                    <div class="mb-3 col-md-6">
                        <label class="form-label">الكود</label>
                        <input type="text" name="code" class="form-control" value="{{ old('code', $record->code) }}"
                            readonly>
                    </div>
                    <div class="mb-3 col-md-6">
                        <label class="form-label">الباركود</label>
                        <input type="text" name="barcode" class="form-control"
                            value="{{ old('barcode', $record->barcode) }}" readonly>
                    </div>
                </div>

                <div class="row">
                    <div class="mb-3 col-md-6">
                        <label class="form-label">الاسم بالعربية</label>
                        <input type="text" name="name_ar" class="form-control"
                            value="{{ old('name_ar', $record->name_ar) }}">
                    </div>
                    <div class="mb-3 col-md-6">
                        <label class="form-label">الاسم بالانجليزية</label>
                        <input type="text" name="name_en" class="form-control"
                            value="{{ old('name_en', $record->name_en) }}">
                    </div>
                </div>

                <div class="row">
                    <div class="mb-3 col-md-6">
                        <label class="form-label">تاريخ التعيين</label>
                        <input type="date" name="hiring_date" class="form-control"
                            value="{{ old('hiring_date', $record->hiring_date?->format('Y-m-d')) }}">
                    </div>
                    <div class="mb-3 col-md-6">
                        <label class="form-label">الحالة</label>
                        <input type="text" name="working_status" class="form-control"
                            value="{{ \App\Enums\Employee\WorkingStatus::labels()[$record->working_status->value ?? $record->working_status] ?? '-' }}"
                            readonly>
                    </div>
                </div>

            </div>

            <!-- شمال -->
            <div class="col-md-6">
                <div class="p-3 mb-3 text-center border rounded">
                    <label for="image" class="form-label fw-bold">الصوره</label>
                    <input class="form-control" type="file" name="employee" id="employeeInput" accept="image/*">
                    <div class="mt-2">
                        <img id="employeePreview"
                            src="{{ $record->getMediaUrl('employee', $record, null, 'media', 'employee', true) }}"
                            alt="" width="100" style="cursor: pointer;" onclick="openImageModal(this.src, 'الصوره')">
                    </div>
                </div>
            </div>
            <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="imageModalLabel">عرض الصورة</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="text-center modal-body">
                            <img id="popupImage" src="" class="rounded img-fluid"
                                style="max-width: 100%; max-height: 80vh;">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- بيانات الوظيفة -->
        <h5 class="mb-3 mt-4 section-title">بيانات الوظيفة</h5>
        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">المستوى</label>
                <input type="text" class="form-control" value="{{ $record->level?->name }}" readonly>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">القسم</label>
                <input type="text" class="form-control" value="{{ $record->section?->name }}" readonly>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">الوظيفة</label>
                <input type="text" class="form-control" value="{{ $record->jobCategory?->name }}" readonly>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">جهة العمل</label>
                <input type="text" class="form-control" value="{{ $record->branch?->name }}" readonly>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">الوردية</label>
                <select name="shift_type_id" class="form-control">
                    <option value="">اختر الوردية</option>
                    @foreach($shiftTypes as $shift)
                    <option value="{{ $shift->id }}" {{ $record->shift_type_id == $shift->id ? 'selected' : '' }}>
                        {{ $shift->type }}
                    </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label">مكان استلام المرتب</label>
                <input type="text" class="form-control" value="{{ $record->salaryPlace?->name }}" readonly>
            </div>
        </div>

        <!-- زرار حفظ -->
        <div class="mt-4 d-flex justify-content-center">
            <button type="submit" class="btn btn-success">حفظ</button>
        </div>
    </form>
</div>
