<!-- Modal Create -->
<div class="modal fade" id="createBranchModal" tabindex="-1" aria-labelledby="createBranchLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form action="{{ route('admin.leave-variables.store') }}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createBranchLabel">إضافة متغير الاجازات</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="إغلاق"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <div class="mb-3">
                                <label class="form-label">كود</label>
                                <input type="text" name="code" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="mb-3">
                                <label class="form-label">الرمز</label>
                                <input type="text" name="symbol" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">وصف عربى</label>
                        <input type="text" name="name_ar" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">وصف انجليزى</label>
                        <input type="text" name="name_en" class="form-control">
                    </div>

                    <div class="col-md-6 mb-3 d-flex align-items-center gap-2">
                        <label class="form-label mb-0" style="white-space: nowrap;">اللون</label>
                        <div class="dropdown flex-grow-1">
                            <button class="btn btn-light dropdown-toggle w-100" type="button" id="colorDropdown" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                اختر اللون
                            </button>
                            <ul class="dropdown-menu p-2" aria-labelledby="colorDropdown" style="min-width: 200px;">
                                <div class="d-flex flex-wrap gap-2">
                                    @foreach(['#ff0000','#00a65a','#007bff','#ffc107','#6f42c1','#17a2b8','#000000','#ffffff'] as $color)
                                    <div class="color-option" data-color="{{ $color }}"
                                        style="width:30px;height:30px;border-radius:50%;cursor:pointer;border:2px solid #ccc;background:{{ $color }};">
                                    </div>
                                    @endforeach

                                    <!-- Color picker icon -->
                                    <div
                                        style="width:30px;height:30px;border-radius:50%;border:2px solid #ccc;display:flex;align-items:center;justify-content:center;cursor:pointer;">
                                        <i class="fa fa-palette" id="openColorPicker"></i>
                                        <input type="color" id="customColorPicker"
                                            style="position:absolute;opacity:0;width:30px;height:30px;cursor:pointer;">
                                    </div>
                                </div>
                            </ul>
                        </div>
                        <input type="hidden" name="color" id="selectedColor" required>
                    </div>

                    <div class="col-md-6 mb-3 d-flex align-items-center gap-3">
                        <!-- Checkbox -->
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="deduct_from_balance" id="deductCheckbox">
                            <label class="form-check-label" for="deductCheckbox">يخصم من الرصيد؟</label>
                        </div>
                        <!-- Input Decimal -->
                        <input type="number" step="0.01" name="deducted_value" id="deductedValue" class="form-control"
                            placeholder="قيمة الخصم" style="width:150px; display:none;">
                    </div>

                    <div class="col-12 mb-3">
                        <div class="d-flex gap-3">
                            <!-- الرصيد -->
                            <div class="flex-fill">
                                <label class="form-label">الرصيد</label>
                                <input type="number" step="0.01" name="balance" class="form-control" placeholder="0.00">
                            </div>
                            <!-- رصيد 10 سنوات -->
                            <div class="flex-fill">
                                <label class="form-label">رصيد عشر سنوات تأمين</label>
                                <input type="number" step="0.01" name="ten_years_balance" class="form-control" placeholder="0.00">
                            </div>
                            <!-- رصيد 50 سنة -->
                            <div class="flex-fill">
                                <label class="form-label">رصيد خمسين سنة</label>
                                <input type="number" step="0.01" name="fifty_years_balance" class="form-control" placeholder="0.00">
                            </div>

                        </div>
                    </div>

                    <div class="col-12 mb-3">
                        <div class="d-flex flex-wrap gap-4">

                            <!-- يمكن ترحيله -->
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="can_transfer" id="can_transfer">
                                <label class="form-check-label" for="can_transfer">يمكن ترحيله</label>
                            </div>

                            <!-- عشر سنوات تأمين -->
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="ten_years_insurance" id="ten_years_insurance">
                                <label class="form-check-label" for="ten_years_insurance">عشر سنوات تأمين</label>
                            </div>

                            <!-- خمسين سنة -->
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="fifty_years" id="fifty_years">
                                <label class="form-check-label" for="fifty_years">خمسين سنة</label>
                            </div>
                            <!-- يؤثر على الإجازة السنوية -->
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="affect_annual_leave" id="affect_annual_leave">
                                <label class="form-check-label" for="affect_annual_leave">يؤثر على الإجازة السنوية</label>
                            </div>

                        </div>
                    </div>



                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إلغاء</button>
                    <button type="submit" class="btn btn-success">حفظ</button>
                </div>
            </div>
        </form>
    </div>
</div>
