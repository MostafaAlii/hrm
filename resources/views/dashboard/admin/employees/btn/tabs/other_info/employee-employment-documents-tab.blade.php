<div class="tab-pane fade" id="employee-employment-documents" role="tabpanel"
    aria-labelledby="employee-employment-documents-tab">
    <div class="mb-2 d-flex justify-content-between">
        <h5 class="mt-2 mb-3 section-title">
            مصوغات التعيين
            <span>{{ '( ' . $record?->name_ar . ' )' }}</span>
        </h5>
        <button type="button" class="btn btn-success" data-bs-toggle="modal"
            data-bs-target="#createEmploymentDocumentModal">
            <i class="fa fa-plus"></i> إضافة
        </button>
    </div>

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>صورة المصوغ</th>
                <th>اسم المصوغ</th>
                <th>حالة التسليم</th>
                <th>ملاحظات</th>
                <th>الإجراءات</th>
            </tr>
        </thead>
        <tbody>
            @forelse($employmentDocuments ?? [] as $document)
            <tr>
                <td>
                    @if($document->document_image)
                    <img src="{{ $document->document_image }}" alt="صورة المصوغ" style="max-width: 80px; max-height: 80px;"
                        class="img-thumbnail">
                    @else
                    <span class="text-muted">لا توجد صورة</span>
                    @endif
                </td>
                <td>{{ $document->employmentDocument?->name_ar }}</td>
                <td>{!! $document->delivery_status_badge !!}</td>
                <td>{{ $document->notes ?? '-' }}</td>
                <td>
                    <div class="btn-group">
                        <button type="button" class="btn btn-sm btn-warning" data-bs-toggle="modal"
                            data-bs-target="#editEmploymentDocumentModal{{ $document->id }}">
                            <i class="fa fa-edit"></i>
                        </button>
                        <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal"
                            data-bs-target="#deleteEmploymentDocumentModal{{ $document->id }}">
                            <i class="fa fa-trash"></i>
                        </button>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="4" class="text-center">لا توجد بيانات</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <!-- Modal الإضافة -->
    <div class="modal fade" id="createEmploymentDocumentModal" tabindex="-1"
        aria-labelledby="createEmploymentDocumentModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <form action="{{ route('admin.employee.employment-documents.store', $record->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="createEmploymentDocumentModalLabel">إضافة مصوغ تعيين</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="إغلاق"></button>
                    </div>
                    <div class="modal-body row g-3">
                        <div class="col-md-6">
                            <label class="form-label">اسم المصوغ <span class="text-danger">*</span></label>
                            <select name="employment_document_id" class="form-select" required>
                                <option value="">-- اختر --</option>
                                @foreach($employmentDocumentsList ?? [] as $doc)
                                <option value="{{ $doc->id }}">{{ $doc->name_ar }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">حالة التسليم <span class="text-danger">*</span></label>
                            <select name="delivery_status" class="form-select" required>
                                <option value="delivered">تم التسليم</option>
                                <option value="not_delivered">لم يتم التسليم</option>
                            </select>
                        </div>
                        <div class="col-md-12">
                            <label class="form-label">صورة المصوغ</label>
                            <input type="file" name="document_image" class="form-control" accept="image/*">
                            <small class="text-muted">يسمح بصور JPEG, PNG, WebP</small>
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

    <!-- Modals التعديل والحذف لكل مصوغ -->
    @foreach($employmentDocuments ?? [] as $document)
    <!-- Modal التعديل -->
    <div class="modal fade" id="editEmploymentDocumentModal{{ $document->id }}" tabindex="-1"
        aria-labelledby="editEmploymentDocumentModalLabel{{ $document->id }}" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <form
                action="{{ route('admin.employee.employment-documents.update', ['employee' => $record->id, 'document' => $document->id]) }}"
                method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editEmploymentDocumentModalLabel{{ $document->id }}">تعديل مصوغ
                            التعيين</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="إغلاق"></button>
                    </div>
                    <div class="modal-body row g-3">
                        <div class="col-md-6">
                            <label class="form-label">اسم المصوغ <span class="text-danger">*</span></label>
                            <select name="employment_document_id" class="form-select" required>
                                <option value="">-- اختر --</option>
                                @foreach($employmentDocumentsList ?? [] as $doc)
                                <option value="{{ $doc->id }}" {{ $document->employment_document_id == $doc->id ?
                                    'selected' : '' }}>
                                    {{ $doc->name_ar }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">حالة التسليم <span class="text-danger">*</span></label>
                            <select name="delivery_status" class="form-select" required>
                                <option value="delivered" {{ $document->delivery_status == 'delivered' ? 'selected' : ''
                                    }}>تم التسليم</option>
                                <option value="not_delivered" {{ $document->delivery_status == 'not_delivered' ?
                                    'selected' : '' }}>لم يتم التسليم</option>
                            </select>
                        </div>
                        <div class="col-md-12">
                            <label class="form-label">صورة المصوغ</label>
                            <input type="file" name="document_image" class="form-control" accept="image/*">
                            <small class="text-muted">يسمح بصور JPEG, PNG, WebP</small>

                            @if($document->document_image)
                            <div class="mt-2">
                                <label class="form-label">الصورة الحالية:</label>
                                <div>
                                    <img src="{{ $document->document_image }}" alt="صورة المصوغ" style="max-width: 200px; max-height: 200px;"
                                        class="img-thumbnail">
                                </div>
                            </div>
                            @endif
                        </div>
                        <div class="col-md-12">
                            <label class="form-label">ملاحظات</label>
                            <textarea name="notes" class="form-control" rows="3">{{ $document->notes }}</textarea>
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
    <div class="modal fade" id="deleteEmploymentDocumentModal{{ $document->id }}" tabindex="-1"
        aria-labelledby="deleteEmploymentDocumentModalLabel{{ $document->id }}" aria-hidden="true">
        <div class="modal-dialog">
            <form
                action="{{ route('admin.employee.employment-documents.destroy', ['employee' => $record->id, 'document' => $document->id]) }}"
                method="POST">
                @csrf
                @method('DELETE')
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteEmploymentDocumentModalLabel{{ $document->id }}">تأكيد الحذف
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="إغلاق"></button>
                    </div>
                    <div class="modal-body">
                        <p>هل أنت متأكد من حذف مصوغ التعيين: <strong>{{ $document->employmentDocument?->name_ar
                                }}</strong>؟</p>
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
