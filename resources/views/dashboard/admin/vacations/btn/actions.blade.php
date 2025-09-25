<div class="d-flex justify-content-center">
    <!-- زرار تعديل -->
    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
        data-bs-target="#editVacationModal{{ $vacation->id }}">
        <i class="fas fa-edit"></i>
    </button>
    <div class="modal fade" id="editVacationModal{{ $vacation->id }}" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">
                        <i class="fa fa-edit"></i>
                        {{ trans('dashboard/vacation.edit_vacation') }}
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                </div>

                <form action="{{ route('admin.vacations.update', $vacation->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body row g-3">

                        {{-- الرمز --}}
                        <div class="col-md-6">
                            <label class="form-label">{{ trans('dashboard/vacation.code') }}</label>
                            <input type="text" name="code" class="form-control" value="{{ $vacation?->code }}" readonly>
                        </div>

                        {{-- الوصف عربي --}}
                        <div class="col-md-6">
                            <label class="form-label">{{ trans('dashboard/vacation.name_ar') }}</label>
                            <input type="text" name="name_ar" class="form-control" value="{{ $vacation->name_ar }}" required>
                        </div>

                        {{-- الوصف انجليزي --}}
                        <div class="col-md-6">
                            <label class="form-label">{{ trans('dashboard/vacation.name_en') }}</label>
                            <input type="text" name="name_en" class="form-control" value="{{ $vacation->name_en }}">
                        </div>

                        {{-- اللون --}}
                        <div class="col-md-6">
                            <label class="form-label">{{ trans('dashboard/vacation.color') }}</label>
                            <input type="color" name="color" class="form-control form-control-color" value="{{ $vacation->color }}">
                        </div>

                        {{-- الرصيد --}}
                        <div class="col-md-6">
                            <label class="form-label">{{ trans('dashboard/vacation.balance') }}</label>
                            <input type="number" name="balance" class="form-control" value="{{ $vacation->balance }}" min="0">
                        </div>

                        {{-- رصيد عشر سنوات تأمين --}}
                        <div class="col-md-6">
                            <label class="form-label">{{ trans('dashboard/vacation.ten_years_balance') }}</label>
                            <input type="number" name="ten_years_balance" class="form-control" value="{{ $vacation->ten_years_balance }}" min="0">
                        </div>

                        {{-- رصيد خمسين سنة --}}
                        <div class="col-md-6">
                            <label class="form-label">{{ trans('dashboard/vacation.fifty_years_balance') }}</label>
                            <input type="number" name="fifty_years_balance" class="form-control" value="{{ $vacation->fifty_years_balance }}" min="0">
                        </div>

                        {{-- قيمة الخصم من الرصيد --}}
                        {{-- قيمة الخصم من الرصيد --}}
                        <div class="col-md-6 {{ $vacation->deduct_from_balance ? '' : 'd-none' }}" 
                            id="editDeductionValueWrapper{{ $vacation->id }}">
                            <label class="form-label">{{ trans('dashboard/vacation.deduction_value') }}</label>
                            <input type="number" name="deduction_value" class="form-control"
                                value="{{ $vacation->deduction_value ?? 0 }}" min="0">
                        </div>




                        {{-- خيارات --}}
                        <div class="col-md-12">
                            <div class="form-check form-check-inline">
                                <input type="checkbox" name="deduct_from_balance" value="1" class="form-check-input toggle-deduction" data-target="editDeductionValueWrapper{{ $vacation->id }}"
                                    {{ $vacation->deduct_from_balance ? 'checked' : '' }}>
                                <label class="form-check-label">{{ trans('dashboard/vacation.deduct_from_balance') }}</label>
                            </div>

                            <div class="form-check form-check-inline">
                                <input type="checkbox" name="can_be_carried_forward" value="1" class="form-check-input"
                                    {{ $vacation->can_be_carried_forward ? 'checked' : '' }}>
                                <label class="form-check-label">{{ trans('dashboard/vacation.can_be_carried_forward') }}</label>
                            </div>

                            <div class="form-check form-check-inline">
                                <input type="checkbox" name="affects_ten_years" value="1" class="form-check-input"
                                    {{ $vacation->affects_ten_years ? 'checked' : '' }}>
                                <label class="form-check-label">{{ trans('dashboard/vacation.affects_ten_years') }}</label>
                            </div>

                            <div class="form-check form-check-inline">
                                <input type="checkbox" name="affects_fifty_years" value="1" class="form-check-input"
                                    {{ $vacation->affects_fifty_years ? 'checked' : '' }}>
                                <label class="form-check-label">{{ trans('dashboard/vacation.affects_fifty_years') }}</label>
                            </div>

                            <div class="form-check form-check-inline">
                                <input type="checkbox" name="affects_annual_leave" value="1" class="form-check-input"
                                    {{ $vacation->affects_annual_leave ? 'checked' : '' }}>
                                <label class="form-check-label">{{ trans('dashboard/vacation.affects_annual_leave') }}</label>
                            </div>
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">
                            <i class="fa fa-times"></i> {{ trans('dashboard/general.close') }}
                        </button>
                        <button type="submit" class="btn btn-primary">
                            <i class="fa fa-save"></i> {{ trans('dashboard/general.update') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <button type="button" class="mx-1 btn btn-danger btn-sm" data-bs-toggle="modal"
        data-bs-target="#deleteModal{{ $vacation->id }}">
        <i class="fas fa-trash"></i>
    </button>

    <div class="modal fade" id="deleteModal{{ $vacation->id }}" tabindex="-1" aria-labelledby="deleteModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">تأكيد الحذف</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="إغلاق"></button>
                </div>
                <div class="text-center modal-body">
                    <p>هل أنت متأكد من حذف "<strong>{{ $vacation->name_ar }}</strong>"؟</p>
                    <p class="text-danger">هذا الإجراء لا يمكن التراجع عنه.</p>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إلغاء</button>
                        <form action="{{ route('admin.vacations.destroy', $vacation->id) }}" method="POST">
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
