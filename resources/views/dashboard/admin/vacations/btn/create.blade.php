<div class="modal fade" id="createVacationModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">
                    <i class="fa fa-plus-circle"></i>
                    {{ trans('dashboard/vacation.add_new_vacation') }}
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
            </div>

            <form action="{{ route('admin.vacations.store') }}" method="POST">
                @csrf
                <div class="modal-body row g-3">

                    {{-- الرمز --}}
                    <div class="col-md-6">
                        <label class="form-label">{{ trans('dashboard/vacation.code') }}</label>
                        <input type="text" name="code" class="form-control" value="" required>
                    </div>

                    {{-- الوصف عربي --}}
                    <div class="col-md-6">
                        <label class="form-label">{{ trans('dashboard/vacation.name_ar') }}</label>
                        <input type="text" name="name_ar" class="form-control" required>
                    </div>

                    {{-- الوصف انجليزي --}}
                    <div class="col-md-6">
                        <label class="form-label">{{ trans('dashboard/vacation.name_en') }}</label>
                        <input type="text" name="name_en" class="form-control">
                    </div>

                    {{-- اللون --}}
                    <div class="col-md-6">
                        <label class="form-label">{{ trans('dashboard/vacation.color') }}</label>
                        <input type="color" name="color" class="form-control form-control-color">
                    </div>

                    {{-- الرصيد --}}
                    <div class="col-md-6">
                        <label class="form-label">{{ trans('dashboard/vacation.balance') }}</label>
                        <input type="number" name="balance" class="form-control" value="0" min="0">
                    </div>

                    {{-- رصيد عشر سنوات تأمين --}}
                    <div class="col-md-6">
                        <label class="form-label">{{ trans('dashboard/vacation.ten_years_balance') }}</label>
                        <input type="number" name="ten_years_balance" class="form-control" value="0" min="0">
                    </div>

                    {{-- رصيد خمسين سنة --}}
                    <div class="col-md-6">
                        <label class="form-label">{{ trans('dashboard/vacation.fifty_years_balance') }}</label>
                        <input type="number" name="fifty_years_balance" class="form-control" value="0" min="0">
                    </div>

                    <div class="col-md-6 d-none" id="deductionValueWrapper">
                        <label class="form-label">{{ trans('dashboard/vacation.deduction_value') }}</label>
                        <input type="number" name="deduction_value" class="form-control" value="0" min="0">
                    </div>


                    <div class="col-md-12">
                        <div class="form-check form-check-inline">
                            <input type="checkbox" name="deduct_from_balance" value="1" class="form-check-input">
                            <label class="form-check-label">{{ trans('dashboard/vacation.deduct_from_balance') }}</label>
                        </div>

                        <div class="form-check form-check-inline">
                            <input type="checkbox" name="can_be_carried_forward" value="1" class="form-check-input">
                            <label class="form-check-label">{{ trans('dashboard/vacation.can_be_carried_forward') }}</label>
                        </div>

                        <div class="form-check form-check-inline">
                            <input type="checkbox" name="affects_ten_years" value="1" class="form-check-input">
                            <label class="form-check-label">{{ trans('dashboard/vacation.affects_ten_years') }}</label>
                        </div>

                        <div class="form-check form-check-inline">
                            <input type="checkbox" name="affects_fifty_years" value="1" class="form-check-input">
                            <label class="form-check-label">{{ trans('dashboard/vacation.affects_fifty_years') }}</label>
                        </div>

                        <div class="form-check form-check-inline">
                            <input type="checkbox" name="affects_annual_leave" value="1" class="form-check-input">
                            <label class="form-check-label">{{ trans('dashboard/vacation.affects_annual_leave') }}</label>
                        </div>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">
                        <i class="fa fa-times"></i> {{ trans('dashboard/general.close') }}
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fa fa-save"></i> {{ trans('dashboard/general.save') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>