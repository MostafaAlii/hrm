<!-- Modal إضافة تخصيص إجازة -->
<div class="modal fade" id="addLeaveAllocationModal" tabindex="-1" aria-labelledby="addLeaveAllocationLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form method="POST" action="{{ route('admin.employee-leave-allocation.store') }}">
            @csrf
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title" id="addLeaveAllocationLabel">إضافة تخصيص إجازة للموظف</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <div class="row">
                        <!-- نوع الإجازة -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">نوع الإجازة</label>
                            <select name="leave_variable_id" class="form-select" required>
                                <option value="">اختر نوع الإجازة</option>
                                @foreach($leaveVariables as $var)
                                <option value="{{ $var->id }}">{{ $var?->code . '-' . $var->name_ar . ' ' . '[ ' . $var?->symbol . ' ]' }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- الرصيد والسنوات -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">الرصيد </label>
                            <input type="number" step="0.01" class="form-control" name="allocated_balance" required>
                        </div>
                    </div>

                    <!-- Checkboxes -->
                    <div class="mt-3 d-flex justify-content-center gap-4 flex-wrap">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="is_year" id="is_year">
                            <label class="form-check-label" for="is_year">عام</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="is_break_year" id="is_break_year">
                            <label class="form-check-label" for="is_break_year">كسر العام</label>
                        </div>
                    </div>
                    <input type="hidden" name="employee_id" value="{{ $emp_record->id }}">
                    <input type="hidden" name="company_id" value="{{ get_user_data()->company_id }}">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إلغاء</button>
                    <button type="submit" class="btn btn-success">حفظ</button>
                </div>

            </div>
        </form>
    </div>
</div>
