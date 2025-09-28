<div class="d-flex justify-content-center">
    <!-- زرار تعديل -->
    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
        data-bs-target="#editPenaltyModal{{ $record->id }}">
        <i class="fas fa-edit"></i>
    </button>

    <!-- Modal Edit -->
    <div class="modal fade" id="editPenaltyModal{{ $record->id }}" tabindex="-1"
        aria-labelledby="editPenaltyLabel{{ $record->id }}" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <form action="{{ route('admin.penalty-types.update', $record->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editPenaltyLabel{{ $record->id }}">تعديل الجزاء
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="إغلاق"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3 row">
                            <div class="col-md-6">
                                <label for="name_ar{{ $record->id }}" class="form-label">الوصف العربي</label>
                                <input type="text" name="name_ar" id="name_ar{{ $record->id }}" class="form-control"
                                    value="{{ old('name_ar', $record->name_ar) }}">
                            </div>
                            <div class="col-md-6">
                                <label for="name_en{{ $record->id }}" class="form-label">الوصف الإنجليزي</label>
                                <input type="text" name="name_en" id="name_en{{ $record->id }}" class="form-control"
                                    value="{{ old('name_en', $record->name_en) }}">
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <div class="col-md-6">
                                <label class="form-label">نوع الجزاء</label>
                                @foreach(\App\Enums\Penalty\PenaltyType::labels() as $key => $label)
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="type" id="type_{{ $key }}{{ $record->id }}" value="{{ $key }}" {{
                                            old('type', $record->type?->value) == $key ? 'checked' : '' }}>
                                        <label class="form-check-label" for="type_{{ $key }}{{ $record->id }}">{{ $label }}</label>
                                    </div>
                                @endforeach
                            </div>
                            <br>
                            <div class="col-md-6 d-flex align-items-center">
                                <div class="form-check">
                                    <input type="hidden" name="affects_salary" value="0">
                                    <input class="form-check-input" type="checkbox" name="affects_salary" id="affects_salary{{ $record->id }}" value="1" {{
                                        old('affects_salary', $record->affects_salary) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="affects_salary{{ $record->id }}">يؤثر على المرتب</label>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="form-label d-block"></label>
                            <div class="flex-wrap gap-3 d-flex">
                                @foreach(\App\Enums\Penalty\CalculationType::labels() as $key => $label)
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="calculation_type" value="{{ $key }}" {{ old('calculation_type',
                                            $record->calculation_type?->value) == $key ? 'checked' : ($loop->first ? 'checked' : '') }}>
                                        <label class="form-check-label">{{ $label }}</label>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        @foreach(['first','second','third','fourth','more_than_four_times'] as $time)
                            @php
                                $column = $time === 'more_than_four_times' ? $time : $time.'_time';
                                $descriptionColumn = $time === 'more_than_four_times' ? $time.'_description' : $time.'_time_description';
                            @endphp
                            <div class="mb-2 row">
                                <div class="col-md-6">
                                    <label class="form-label">
                                        {{ $time == 'more_than_four_times' ? 'أكثر من أربع مرات' : 'للمرة '. ucfirst($time) }}
                                    </label>
                                    <input type="number" step="0.01" name="{{ $column }}" class="form-control"
                                        value="{{ old($column, $record->$column) }}">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label"></label>
                                    <input type="text" name="{{ $descriptionColumn }}" class="form-control"
                                        value="{{ old($descriptionColumn, $record->$descriptionColumn) }}">
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إلغاء</button>
                        <button type="submit" class="btn btn-success">تحديث</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Delete Button (Optional) -->
    <button type="button" class="mx-1 btn btn-danger btn-sm" data-bs-toggle="modal"
        data-bs-target="#deleteModal{{ $record->id }}">
        <i class="fas fa-trash"></i>
    </button>

    <div class="modal fade" id="deleteModal{{ $record->id }}" tabindex="-1" aria-labelledby="deleteModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">تأكيد الحذف</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="إغلاق"></button>
                </div>
                <div class="text-center modal-body">
                    <p>هل أنت متأكد من حذف "<strong>{{ $record->name_ar }}</strong>"؟</p>
                    <p class="text-danger">هذا الإجراء لا يمكن التراجع عنه.</p>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إلغاء</button>
                        <form action="{{ route('admin.penalty-types.destroy', $record->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">نعم، حذف</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
