<div class="tab-pane fade" id="military" role="tabpanel" aria-labelledby="military-tab">
    <form action="{{ route('admin.employee.update_military_service', $record->id) }}" method="POST"
        enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="mb-3 col-md-12">
                <label class="form-label d-block">الموقف من التجنيد</label>
                <div class="d-flex flex-wrap gap-3">
                    @foreach(\App\Enums\Employee\MilitaryStatus::options() as $status)
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="status" id="status_{{ $status['value'] }}"
                            value="{{ $status['value'] }}" {{ old('status', $record->militaryService?->status?->value)
                        == $status['value'] ? 'checked' : '' }}>
                        <label class="form-check-label" for="status_{{ $status['value'] }}">
                            {{ $status['label'] }}
                        </label>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="row">
            <!-- الجزء اليمين -->
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label">رقم البطاقة العسكرية</label>
                    <input type="text" name="military_card_number" class="form-control"
                        value="{{ old('military_card_number', $record->militaryService?->military_card_number) }}">
                </div>
                <div class="row">
                    <div class="mb-3 col-md-6">
                        <label class="form-label">تاريخ الصدور</label>
                        <input type="date" name="issue_date" class="form-control"
                            value="{{ old('issue_date', $record->militaryService?->issue_date?->format('Y-m-d')) }}">
                    </div>

                    <div class="mb-3 col-md-6">
                        <label class="form-label">تاريخ الانتهاء</label>
                        <input type="date" name="expiry_date" class="form-control"
                            value="{{ old('expiry_date', $record->militaryService?->expiry_date?->format('Y-m-d')) }}">
                    </div>
                </div>

                <div class="mb-3 col-md-12">
                    <label class="form-label">رقم الدفعة</label>
                    <input type="text" name="batch_number" class="form-control"
                        value="{{ old('batch_number', $record->militaryService?->batch_number) }}">
                </div>
            </div>

            <!-- الجزء الشمال -->
            <div class="col-md-6">
                <div class="p-3 mb-3 text-center border rounded">
                    <label for="image" class="form-label fw-bold">الصوره</label>
                    <input class="form-control" type="file" name="employeeMilitaryCertificate"
                        id="employeeMilitaryCertificateInput" accept="image/*">

                    @if($record->militaryService)
                    <div class="mt-2">
                        <img id="employeeMilitaryCertificatePreview"
                            src="{{ $record->militaryService->getMediaUrl('employeeMilitaryCertificates', $record->militaryService, null, 'media', 'employeeMilitaryCertificate') }}"
                            alt="صورة" width="100" style="cursor: pointer;"
                            onclick="openImageModal(this.src, 'الصوره')">
                    </div>
                    @endif
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

            <div class="mb-3 col-md-12">
                <label class="form-label">معلومات أخرى</label>
                <textarea name="additional_info" class="form-control"
                    rows="3">{{ old('additional_info', $record->militaryService?->additional_info) }}</textarea>
            </div>
        </div>

        <div class="mt-3 text-end">
            <button type="submit" class="btn btn-success">حفظ البيانات</button>
        </div>
    </form>
</div>
