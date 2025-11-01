<div class="tab-pane fade show active" id="salary-details" role="tabpanel" aria-labelledby="salary-details-tab">
    <div class="card">
        <div class="card-header">
            <h5 class="card-title mb-0">إدارة المرتب</h5>
        </div>

        <!-- تبويبات إدارة المرتب -->
        <div class="card-body">
            {{--@php
            use App\Helpers\InsuranceHelper;
            $healthInsurance = InsuranceHelper::calculateComprehensiveHealthInsurance($record->id);
            $socialInsurance = InsuranceHelper::calculateSocialInsurance($record->id);
            $insuranceData = InsuranceHelper::getSettingsByEmployee($record->id);
            @endphp

            @if ($insuranceData)
            <p>
                <strong>حالة التأمين:</strong>
                @if ($insuranceData['is_insured'])
                <span class="text-success"><i class="fa fa-check-circle"></i> مؤمن عليه</span>
                @else
                <span class="text-danger"><i class="fa fa-times-circle"></i> غير مؤمن عليه</span>
                @endif
            </p>

            @if ($insuranceData['is_insured'] && $insuranceData['settings'])
            @php $setting = $insuranceData['settings']; @endphp
            <p>الحد الأدنى: {{ $setting['min_insurance_amount'] }}</p>
            <p>الحد الأقصى: {{ $setting['max_insurance_amount'] }}</p>
            <p>نسبة خصم الموظف: {{ $setting['employee_deduction_percentage'] }}%</p>
            <p>نسبة خصم الشركة: {{ $setting['company_deduction_percentage'] }}%</p>
            <p class="fw-bold text-success">قيمة التأمين الصحي الشامل: {{ $healthInsurance }} جنيه</p>
            <p class="fw-bold text-primary">
                <i class="fa fa-users me-1"></i>
                التأمين الاجتماعي: {{ $socialInsurance }} جنيه
            </p>
            @elseif ($insuranceData['is_insured'] && ! $insuranceData['settings'])
            <p class="text-danger">لا توجد إعدادات تأمين مسجلة لهذه الشركة.</p>
            @endif
            @else
            <p class="text-danger">لا يمكن جلب بيانات التأمين.</p>
            @endif--}}
            <!-- Nav Tabs -->
            <ul class="nav nav-tabs" id="salaryTabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="salary-info-tab"
                            data-bs-toggle="tab"
                            data-bs-target="#salary-info"
                            type="button"
                            role="tab"
                            aria-controls="salary-info"
                            aria-selected="true">
                        تفاصيل المرتب
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="salary-data-tab"
                            data-bs-toggle="tab"
                            data-bs-target="#salary-data"
                            type="button"
                            role="tab"
                            aria-controls="salary-data"
                            aria-selected="false">
                        بيانات المرتب
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="salary-basic-tab"
                            data-bs-toggle="tab"
                            data-bs-target="#salary-basic"
                            type="button"
                            role="tab"
                            aria-controls="salary-basic"
                            aria-selected="false">
                         تفاصيل الاساسى
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="salary-allowance-tab" data-bs-toggle="tab" data-bs-target="#salary-allowance" type="button"
                        role="tab" aria-controls="salary-allowance" aria-selected="false">
                        تفاصيل العلاوات
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="universal-health-insurance-tab" data-bs-toggle="tab" data-bs-target="#universal-health-insurance"
                        type="button" role="tab" aria-controls="universal-health-insurance" aria-selected="false">
                        تفاصيل التامين الصحى الشامل
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="social-insurance-tab" data-bs-toggle="tab"
                        data-bs-target="#social-insurance" type="button" role="tab" aria-controls="social-insurance"
                        aria-selected="false">
                        تفاصيل التامين الاجتماعى
                    </button>
                </li>
            </ul>

            <!-- محتوى التبويبات -->
            <div class="tab-content mt-3" id="salaryTabsContent">
                <div class="tab-pane fade show active" id="salary-info" role="tabpanel" aria-labelledby="salary-info-tab">
                    <!-- Start Button Bar -->
                    <div class="d-flex flex-wrap gap-3 mb-4">
                        <!-- أساسي -->
                        <button type="button" class="btn btn-primary btn-lg d-flex align-items-center" data-bs-toggle="modal"
                            data-bs-target="#basicModal">
                            <i class="fa fa-money-bill-wave me-2"></i>
                            أساسي
                        </button>

                        <!-- علاوة -->
                        <button type="button" class="btn btn-success btn-lg d-flex align-items-center" data-bs-toggle="modal"
                            data-bs-target="#allowanceModal">
                            <i class="fa fa-chart-line me-2"></i>
                            علاوة
                        </button>

                        <!-- استحقاق -->
                        <button type="button" class="btn btn-info btn-lg d-flex align-items-center" data-bs-toggle="modal"
                            data-bs-target="#entitlementModal">
                            <i class="fa fa-award me-2"></i>
                            استحقاق
                        </button>

                        <!-- استقطاع -->
                        <button type="button" class="btn btn-warning btn-lg d-flex align-items-center" data-bs-toggle="modal"
                            data-bs-target="#deductionModal">
                            <i class="fa fa-hand-holding-usd me-2"></i>
                            استقطاع
                        </button>

                        <!-- تأمين متغير -->
                        <button type="button" class="btn btn-danger btn-lg d-flex align-items-center" data-bs-toggle="modal"
                            data-bs-target="#variableInsuranceModal">
                            <i class="fa fa-shield-alt me-2"></i>
                            تأمين الصحى الشامل
                        </button>

                        <!-- تأمين ثابت -->
                        <button type="button" class="btn btn-secondary btn-lg d-flex align-items-center" data-bs-toggle="modal"
                            data-bs-target="#socialInsuranceModal">
                            <i class="fa fa-shield me-2"></i>
                            التأمين الاجتماعى
                        </button>
                    </div>
                    <!-- End Button Bar -->
                    <!-- Start Salary Table -->
                    <div class="table-responsive mt-3">
                        <table class="table table-bordered text-center align-middle" style="font-size: 14px;">
                            <thead class="bg-primary text-white">
                                <tr>
                                    <th>الكود</th>
                                    <th>البند</th>
                                    <th>تاريخ الإضافة</th>
                                    <th>الفترة</th>
                                    <th>القيمة</th>
                                    <th>زيادة المرتب</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- 🟩 عرض الاستحقاقات --}}
                                @foreach($record->entitlements as $entitlement)
                                <tr style="background-color:#e8f5e9;">
                                    <td>{{ $entitlement?->entitlementVariable?->code ?? '-' }}</td>
                                    <td>{{ $entitlement?->entitlementVariable?->name_ar ?? '-' }}</td>
                                    <td>{{ $entitlement->created_at?->format('Y-m-d H:i:s') }}</td>
                                    <td>{{ $entitlement->period ?? '-' }}</td>
                                    <td>{{ number_format($entitlement->amount, 2) }}</td>
                                    <td>{{ number_format($entitlement->amount, 2) }}</td>
                                </tr>
                                @endforeach

                                {{-- 🟥 عرض الاستقطاعات --}}
                                @foreach($record->deductions as $deduction)
                                <tr style="background-color:#ffebee;">
                                    <td>{{ $deduction?->variable?->code ?? '-' }}</td>
                                    <td>{{ $deduction?->variable?->name_ar ?? '-' }}</td>
                                    <td>{{ $deduction->created_at?->format('Y-m-d H:i:s') }}</td>
                                    <td>{{ $deduction->period ?? '-' }}</td>
                                    <td>{{ number_format($deduction->amount, 2) }}</td>
                                    <td>{{ number_format($deduction->amount, 2) }}</td>
                                </tr>
                                @endforeach

                                {{-- 🧾 الإجماليات --}}
                                <tr style="background-color:#e8f5e9;">
                                    <td colspan="4"></td>
                                    <td><strong>إجمالي الأساسي</strong></td>
                                    <td>{{ number_format($record?->total_basic_salary, 2) }}</td>
                                </tr>

                                <tr style="background-color:#e3f2fd;">
                                    <td colspan="4"></td>
                                    <td><strong>إجمالي العلاوة</strong></td>
                                    <td>{{ number_format($record?->total_allowances, 2) }}</td>
                                </tr>

                                <tr style="background-color:#f1f8e9;">
                                    <td colspan="4"></td>
                                    <td><strong>إجمالي الاستحقاقات</strong></td>
                                    <td>{{ number_format($record?->entitlements_sum, 2) }}</td>
                                </tr>

                                <tr style="background-color:#fff8e1;">
                                    <td colspan="4"></td>
                                    <td><strong>الإجمالي</strong></td>
                                    <td>{{ number_format($record?->total_salary, 2) }}</td>
                                </tr>

                                <tr style="background-color:#ffebee;">
                                    <td colspan="4"></td>
                                    <td><strong>إجمالي الاستقطاعات</strong></td>
                                    <td>-{{ number_format($record?->total_deductions, 2) }}</td>
                                </tr>
                                <!-- Start Tax Modal -->
                                <tr style="background-color:#fce4ec;">
                                    <td colspan="4"></td>
                                    <td><strong>إجمالي الضرائب</strong></td>
                                    <td>
                                        <a href="#" class="text-danger" data-bs-toggle="modal" data-bs-target="#taxDetailsModal{{ $record->id }}">
                                            {{ number_format($record->monthly_tax, 2) }}
                                        </a>
                                    </td>
                                </tr>
                                <tr style="background-color:#e0f2f1;">
                                    <td colspan="4"></td>
                                    <td><strong>إجمالي التامين الاجتماعى</strong></td>
                                    <td>-{{ number_format($record->social_insurance, 2) }}</td>
                                </tr>

                                <tr style="background-color:#e0f2f1;">
                                    <td colspan="4"></td>
                                    <td><strong>إجمالي التامين الصحى الشامل</strong></td>
                                    <td>-{{ number_format($record->comprehensive_insurance ?? 0, 2) }}</td>
                                </tr>

                                <tr style="background-color:#e0f7fa;">
                                    <td colspan="4"></td>
                                    <td><strong>الصافي</strong></td>
                                    <td><strong>{{ number_format(($record?->total_salary - $record?->total_deductions -
                                            $record->monthly_tax - $record->total_insurance),
                                            2) }}</strong></td>
                                </tr>
                            </tbody>
                        </table>
                        <!-- Modal for Tax Details -->
                        <div class="modal fade" id="taxDetailsModal{{ $record->id }}" tabindex="-1"
                            aria-labelledby="taxDetailsModalLabel{{ $record->id }}" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header bg-danger text-white">
                                        <h5 class="modal-title" id="taxDetailsModalLabel{{ $record->id }}">
                                            <i class="fas fa-receipt"></i> تفاصيل حساب الضرائب - {{ $record->name_ar }}
                                        </h5>
                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        @php
                                        $taxCalculation = \App\Models\EmployeeTaxCalculation::where('employee_id', $record->id)
                                        ->latest()
                                        ->first();
                                        @endphp
                        
                                        @if($taxCalculation && !empty($taxCalculation->brackets_breakdown))
                                        <!-- Basic Information -->
                                        <div class="row mb-4">
                                            <div class="col-md-6">
                                                <div class="card border-primary">
                                                    <div class="card-header bg-primary text-white">
                                                        <h6 class="mb-0"><i class="fas fa-info-circle"></i> المعلومات الأساسية</h6>
                                                    </div>
                                                    <div class="card-body">
                                                        <table class="table table-sm table-borderless">
                                                            <tr>
                                                                <td><strong>الراتب الشهري:</strong></td>
                                                                <td>{{ number_format($taxCalculation->monthly_salary, 2) }} جنيه</td>
                                                            </tr>
                                                            <tr>
                                                                <td><strong>الراتب السنوي:</strong></td>
                                                                <td>{{ number_format($taxCalculation->annual_salary, 2) }} جنيه</td>
                                                            </tr>
                                                            <tr>
                                                                <td><strong>المبلغ الخاضع للضريبة:</strong></td>
                                                                <td>{{ number_format($taxCalculation->monthly_taxable_income, 2) }} جنيه / شهر
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="card border-success">
                                                    <div class="card-header bg-success text-white">
                                                        <h6 class="mb-0"><i class="fas fa-calculator"></i> إجمالي الضرائب</h6>
                                                    </div>
                                                    <div class="card-body">
                                                        <table class="table table-sm table-borderless">
                                                            <tr>
                                                                <td><strong>الضريبة الشهرية:</strong></td>
                                                                <td class="text-danger"><strong>{{ number_format($taxCalculation->monthly_tax,
                                                                        2) }} جنيه</strong></td>
                                                            </tr>
                                                            <tr>
                                                                <td><strong>الضريبة السنوية:</strong></td>
                                                                <td class="text-danger"><strong>{{ number_format($taxCalculation->annual_tax, 2)
                                                                        }} جنيه</strong></td>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                        
                                        <!-- Tax Brackets Breakdown -->
                                        <div class="card border-warning">
                                            <div class="card-header bg-warning text-dark">
                                                <h6 class="mb-0"><i class="fas fa-layer-group"></i> تفاصيل الشرائح الضريبية</h6>
                                            </div>
                                            <div class="card-body">
                                                <div class="table-responsive">
                                                    <table class="table table-bordered table-hover">
                                                        <thead class="table-light">
                                                            <tr>
                                                                <th>#</th>
                                                                <th>اسم الشريحة</th>
                                                                <th>المبلغ في الشريحة (سنوي)</th>
                                                                <th>نسبة الضريبة</th>
                                                                <th>الضريبة السنوية</th>
                                                                <th>الضريبة الشهرية</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach($taxCalculation->brackets_breakdown as $index => $bracket)
                                                            <tr>
                                                                <td>{{ $index + 1 }}</td>
                                                                <td>
                                                                    <span class="badge bg-primary">شريحة {{ $bracket['bracket_name'] }}</span>
                                                                </td>
                                                                <td>{{ number_format($bracket['amount_in_bracket'], 2) }} جنيه</td>
                                                                <td>
                                                                    <span class="badge bg-info">{{ $bracket['tax_rate'] }}%</span>
                                                                </td>
                                                                <td class="text-danger">
                                                                    <strong>{{ number_format($bracket['annual_tax_amount'], 2) }} جنيه</strong>
                                                                </td>
                                                                <td class="text-danger">
                                                                    <strong>{{ number_format($bracket['monthly_tax_amount'], 2) }} جنيه</strong>
                                                                </td>
                                                            </tr>
                                                            @endforeach
                                                        </tbody>
                                                        <tfoot class="table-dark">
                                                            <tr>
                                                                <td colspan="4" class="text-end"><strong>الإجمالي:</strong></td>
                                                                <td><strong>{{ number_format($taxCalculation->annual_tax, 2) }} جنيه</strong>
                                                                </td>
                                                                <td><strong>{{ number_format($taxCalculation->monthly_tax, 2) }} جنيه</strong>
                                                                </td>
                                                            </tr>
                                                        </tfoot>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        @else
                                        <div class="alert alert-warning text-center">
                                            <i class="fas fa-exclamation-triangle"></i>
                                            لا توجد بيانات ضريبية متاحة لهذا الموظف
                                        </div>
                                        @endif
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                            <i class="fas fa-times"></i> إغلاق
                                        </button>
                                        <button type="button" class="btn btn-primary">
                                            <i class="fas fa-print"></i> طباعة التقرير
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Tax Modal -->
                    </div>
                    <!-- End Salary Table -->
                </div>
                <div class="tab-pane fade" id="salary-data" role="tabpanel" aria-labelledby="salary-data-tab">
                    <form id="salaryDataForm" class="p-3">
                        <!-- 🟢 قسم بيانات التكلفة والضرائب -->
                        <h6 class="fw-bold text-primary mb-3 border-bottom pb-2">
                            <i class="fa fa-calculator me-2"></i> بيانات التكلفة والضرائب
                        </h6>
                        <div class="row mb-4">
                            <div class="col-md-6 mb-3">
                                <label for="costCenter" class="form-label fw-bold">مركز التكلفة</label>
                                <input type="text" class="form-control" id="costCenter" name="cost_center" placeholder="ادخل مركز التكلفة">
                            </div>
                            <div class="col-md-3 mb-3 d-flex align-items-center">
                                <div class="form-check mt-4">
                                    <input class="form-check-input" type="checkbox" id="isTaxable" name="is_taxable">
                                    <label class="form-check-label fw-bold" for="isTaxable">يخضع للضريبة</label>
                                </div>
                            </div>
                            <div class="col-md-3 mb-3 d-flex align-items-center">
                                <div class="form-check mt-4">
                                    <input class="form-check-input" type="checkbox" id="includeTaxInSalary" name="include_tax_in_salary">
                                    <label class="form-check-label fw-bold" for="includeTaxInSalary">معالجة الضرائب في المرتب</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="taxableAmount" class="form-label fw-bold">المبلغ الخاضع للضريبة</label>
                                <input type="number" step="0.01" class="form-control" id="taxableAmount" name="taxable_amount" placeholder="ادخل المبلغ الخاضع للضريبة">
                            </div>
                        </div>

                        <!-- 🟢 قسم بيانات الاستحقاقات -->
                        <h6 class="fw-bold text-success mb-3 border-bottom pb-2">
                            <i class="fa fa-plus-circle me-2"></i> بيانات الاستحقاقات
                        </h6>
                        <div class="row mb-4">
                            <div class="col-md-3 mb-3">
                                <label for="basicSalary" class="form-label fw-bold">الأساسي</label>
                                <input type="number" step="0.01" class="form-control" id="basicSalary" name="basic_salary" placeholder="قيمة الأساسي" value="{{ $record?->salaryBasic?->basic_salary ?? 0 }}" readonly>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="allowances" class="form-label fw-bold">العلاوات</label>
                                <input type="number" step="0.01" class="form-control" id="allowances" name="allowances" placeholder="قيمة العلاوات">
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="entitlements" class="form-label fw-bold">الاستحقاقات</label>
                                <input type="number" step="0.01" class="form-control" id="entitlements" name="entitlements" placeholder="قيمة الاستحقاقات">
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="totalSalary" class="form-label fw-bold">الإجمالي</label>
                                <input type="number" step="0.01" class="form-control" id="totalSalary" name="total_salary" placeholder="الإجمالي الكلي">
                            </div>
                        </div>

                        <!-- 🟢 قسم بيانات الاستقطاعات -->
                        <h6 class="fw-bold text-danger mb-3 border-bottom pb-2">
                            <i class="fa fa-minus-circle me-2"></i> بيانات الاستقطاعات
                        </h6>
                        <div class="row mb-4">
                            <div class="col-md-4 mb-3">
                                <label for="deductions" class="form-label fw-bold">الاستقطاعات</label>
                                <input type="number" step="0.01" class="form-control" id="deductions" name="deductions" placeholder="قيمة الاستقطاعات">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="taxes" class="form-label fw-bold">الضرائب</label>
                                <input type="number" step="0.01" class="form-control" id="taxes" name="taxes" placeholder="قيمة الضرائب">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="netAfterDeductions" class="form-label fw-bold">الصافي بعد الاستقطاعات</label>
                                <input type="number" step="0.01" class="form-control" id="netAfterDeductions" name="net_after_deductions" placeholder="الصافي">
                            </div>
                        </div>

                        <!-- 🟢 قسم بيانات التأمين -->
                        <h6 class="fw-bold text-info mb-3 border-bottom pb-2">
                            <i class="fa fa-shield-alt me-2"></i> بيانات التأمين
                        </h6>
                        <div class="row mb-4">
                            <div class="col-md-4 mb-3">
                                <label for="fixedInsurance" class="form-label fw-bold">التأمين الثابت</label>
                                <input type="number" step="0.01" class="form-control" id="fixedInsurance" name="fixed_insurance" placeholder="قيمة التأمين الثابت">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="supplementaryInsurance" class="form-label fw-bold">التأمين المكمل</label>
                                <input type="number" step="0.01" class="form-control" id="supplementaryInsurance" name="supplementary_insurance" placeholder="قيمة التأمين المكمل">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="netAfterInsurance" class="form-label fw-bold">الصافي بعد التأمين</label>
                                <input type="number" step="0.01" class="form-control" id="netAfterInsurance" name="net_after_insurance" placeholder="الصافي بعد التأمين">
                            </div>
                        </div>

                        <!-- زر الحفظ -->
                        <div class="text-end">
                            <button type="submit" class="btn btn-primary px-4">
                                <i class="fa fa-save me-2"></i> حفظ البيانات
                            </button>
                        </div>
                    </form>
                </div>
                <div class="tab-pane fade" id="salary-basic" role="tabpanel" aria-labelledby="salary-basic-tab">
                    <div class="table-responsive mt-3">
                        <table class="table table-bordered text-center align-middle" style="font-size: 14px;">
                            <thead class="bg-primary text-white">
                                <tr>
                                    <th>#</th>
                                    <th>الأساسي</th>
                                    <th>تاريخ الإضافة</th>
                                    <th>الفترة</th>
                                    <th>القيمة</th>
                                    <th>زيادة المرتب</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($record->salaryBasics as $index => $basic)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $basic->title ?? 'الأساسي' }}</td>
                                    <td>{{ $basic->created_at?->format('Y-m-d H:i') }}</td>
                                    <td>{{ $basic->period ?? '-' }}</td>
                                    <td>{{ number_format($basic->basic_salary, 2) }}</td>
                                    <td>{{ number_format($basic->basic_salary, 2) }}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="text-muted">لا توجد بيانات أساسي حالياً</td>
                                </tr>
                                @endforelse

                                {{-- صف الإجمالي --}}
                                <tr class="fw-bold" style="background-color: #e8f5e9;">
                                    <td colspan="5" class="text-end"><strong>الإجمالي:</strong></td>
                                    <td colspan="2">{{ number_format($record->salaryBasics->sum('basic_salary'), 2) }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="tab-pane fade" id="salary-allowance" role="tabpanel" aria-labelledby="salary-allowance-tab">
                    <div class="table-responsive mt-3">
                        <table class="table table-bordered text-center align-middle" style="font-size: 14px;">
                            <thead class="bg-primary text-white">
                                <tr>
                                    <th>#</th>
                                    <th>العلاوة</th>
                                    <th>تاريخ الإضافة</th>
                                    <th>الفترة</th>
                                    <th>القيمة</th>
                                    <th>زيادة المرتب</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($record->allowances as $index => $allowance)
                                <tr>
                                    <td>{{ $allowance->allowanceVariable?->code }}</td>
                                    <td>{{ $allowance->allowanceVariable?->name_ar ?? '—' }}</td>
                                    <td>{{ $allowance->created_at?->format('Y-m-d H:i') }}</td>
                                    <td>{{ $allowance->period ?? '-' }}</td>
                                    <td>{{ number_format($allowance->amount, 2) }}</td>
                                    <td>{{ number_format($allowance->amount, 2) }}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="text-muted">لا توجد علاوات حالياً</td>
                                </tr>
                                @endforelse

                                {{-- صف الإجمالي --}}
                                <tr class="fw-bold" style="background-color: #e3f2fd;">
                                    <td colspan="4" class="text-end"><strong>الإجمالي:</strong></td>
                                    <td colspan="2">{{ number_format($record->allowances->sum('amount'), 2) }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="tab-pane fade" id="universal-health-insurance" role="tabpanel"
                    aria-labelledby="universal-health-insurance-tab">
                    <div class="table-responsive mt-3">
                        <table class="table table-bordered text-center align-middle" style="font-size: 14px;">
                            <thead class="bg-danger text-white">
                                <tr>
                                    <th>#</th>
                                    <th>تاريخ الإضافة</th>
                                    <th>الفترة</th>
                                    <th>القيمة</th>
                                    <th>نقص المرتب</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($record->variableInsurances as $index => $insurance)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $insurance->created_at?->format('Y-m-d H:i') }}</td>
                                    <td>
                                        {{-- $insurance->type ?? '—' --}}
                                    </td>
                                    <td>{{ number_format($insurance->value, 2) }}</td>
                                    <td>
                                        {{ number_format($insurance->value, 2) }}
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-muted">لا توجد بيانات للتأمين الصحي الشامل حالياً</td>
                                </tr>
                                @endforelse
                                <tr class="fw-bold" style="background-color: #fdecea;">
                                    <td colspan="3" class="text-end"><strong>الإجمالي:</strong></td>
                                    <td colspan="2">{{ number_format($record->variableInsurances->sum('value'), 2) }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="tab-pane fade" id="social-insurance" role="tabpanel" aria-labelledby="social-insurance-tab">
                    <div class="table-responsive mt-3">
                        <table class="table table-bordered text-center align-middle" style="font-size: 14px;">
                            <thead class="bg-danger text-white">
                                <tr>
                                    <th>#</th>
                                    <th>تاريخ الإضافة</th>
                                    <th>الفترة</th>
                                    <th>القيمة</th>
                                    <th>نقص المرتب</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($record->socialInsurances as $index => $socialInsurance)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $socialInsurance->created_at?->format('Y-m-d H:i') }}</td>
                                    <td>
                                        {{-- $insurance->type ?? '—' --}}
                                    </td>
                                    <td>{{ number_format($socialInsurance->value, 2) }}</td>
                                    <td>
                                        {{ number_format($socialInsurance->value, 2) }}
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-muted">لا توجد بيانات للتأمين اجتماعى حالياً</td>
                                </tr>
                                @endforelse
                                <tr class="fw-bold" style="background-color: #fdecea;">
                                    <td colspan="3" class="text-end"><strong>الإجمالي:</strong></td>
                                    <td colspan="2">{{ number_format($record->socialInsurances->sum('value'), 2) }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="basicModal" tabindex="-1" aria-labelledby="basicModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="basicModalLabel">
                    <i class="fa fa-money-bill-wave me-2"></i>
                    إدارة الأساسي
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @php
                    use App\Models\AllowanceVariable;
                    $allowanceVariables = AllowanceVariable::get();
                @endphp
                <div class="col-md-6">
                    <label for="allowanceSelect" class="form-label fw-bold">اختر العلاوة</label>
                    <select class="form-select" id="allowanceSelect" name="allowance_variable_id">
                        <option value="">-- اختر العلاوة --</option>
                        @foreach($allowanceVariables as $allowance)
                            <option value="{{ $allowance->id }}">{{ $allowance->name_ar }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="basicSalary" class="form-label fw-bold">قيمة الأساسي</label>
                    <input type="number" step="0.01" class="form-control" id="basicSalary" name="basic_salary" placeholder="ادخل قيمة الأساسي" required>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إغلاق</button>
                <button type="button" class="btn btn-primary">حفظ</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal علاوة -->
<div class="modal fade" id="allowanceModal" tabindex="-1" aria-labelledby="allowanceModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title" id="allowanceModalLabel">
                    <i class="fa fa-chart-line me-2"></i>
                    إدارة العلاوات
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">


                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="allowanceSelect" class="form-label fw-bold">اختر العلاوة</label>
                        <select class="form-select" id="allowanceSelect" name="allowance_variable_id">
                            <option value="">-- اختر العلاوة --</option>
                            @foreach($allowanceVariables as $allowance)
                                <option value="{{ $allowance->id }}">{{ $allowance->name_ar }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="allowanceAmount" class="form-label fw-bold">قيمة العلاوة</label>
                        <input type="number" step="0.01" class="form-control" id="allowanceAmount" name="amount" placeholder="ادخل قيمة العلاوة" required>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إغلاق</button>
                <button type="button" class="btn btn-success">حفظ</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal استحقاق -->
<div class="modal fade" id="entitlementModal" tabindex="-1" aria-labelledby="entitlementModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-info text-white">
                <h5 class="modal-title" id="entitlementModalLabel">
                    <i class="fa fa-award me-2"></i>
                    إدارة الاستحقاقات
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @php
                    use App\Models\EntitlementVariable;
                    $entitlementVariables = EntitlementVariable::get();
                @endphp
                <div class="col-md-6 mb-3">
                    <label for="entitlementSelect" class="form-label fw-bold">اختر الاستحقاق</label>
                    <select class="form-select" id="entitlementSelect" name="entitlement_variable_id">
                        <option value="">-- اختر الاستحقاق --</option>
                        @foreach($entitlementVariables as $entitlement)
                            <option value="{{ $entitlement->id }}">{{ $entitlement->name_ar }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="entitlementAmount" class="form-label fw-bold">قيمة الاستحقاق</label>
                    <input type="number" step="0.01" class="form-control" id="entitlementAmount" name="amount" placeholder="ادخل قيمة الاستحقاق" required>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إغلاق</button>
                <button type="button" class="btn btn-info" id="saveEntitlement">حفظ</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal استقطاع -->
<div class="modal fade" id="deductionModal" tabindex="-1" aria-labelledby="deductionModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-warning text-white">
                <h5 class="modal-title" id="deductionModalLabel">
                    <i class="fa fa-hand-holding-usd me-2"></i>
                    إدارة الاستقطاعات
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @php
                    use App\Models\DeductionVariable;
                    $deductionVariables = DeductionVariable::get();
                @endphp

                <div class="col-md-6 mb-3">
                    <label for="deductionSelect" class="form-label fw-bold">اختر نوع الاستقطاع</label>
                    <select class="form-select" id="deductionSelect" name="deduction_variable_id">
                        <option value="">-- اختر الاستقطاع --</option>
                        @foreach($deductionVariables as $deduction)
                            <option value="{{ $deduction->id }}">{{ $deduction->name_ar }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="deductionAmount" class="form-label fw-bold">قيمة الاستقطاع</label>
                    <input type="number" step="0.01" class="form-control" id="deductionAmount" name="amount" placeholder="ادخل قيمة الاستقطاع" required>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إغلاق</button>
                <button type="button" class="btn btn-warning" id="saveDeduction">حفظ</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal تأمين صحى الشامل -->
<div class="modal fade" id="variableInsuranceModal" tabindex="-1" aria-labelledby="variableInsuranceModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="variableInsuranceModalLabel">
                    <i class="fa fa-shield-alt me-2"></i>
                    إدارة تامين صحى الشامل
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="insuranceType" class="form-label fw-bold">النوع</label>
                        <select id="insuranceType" class="form-select">
                            <option value="amount">قيمة</option>
                            <option value="percentage">نسبة %</option>
                        </select>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="insuranceValue" class="form-label fw-bold">القيمة / النسبة</label>
                        <input type="number" step="0.01" class="form-control" id="insuranceValue"
                            placeholder="ادخل القيمة أو النسبة">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إغلاق</button>
                <button type="button" class="btn btn-danger" id="saveVariableInsurance">حفظ</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal تأمين اجتماعي -->
<div class="modal fade" id="socialInsuranceModal" tabindex="-1" aria-labelledby="socialInsuranceModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-secondary text-white">
                <h5 class="modal-title" id="socialInsuranceModalLabel">
                    <i class="fa fa-briefcase me-2"></i>
                    إدارة التأمين الاجتماعي
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="socialInsuranceType" class="form-label fw-bold">النوع</label>
                        <select id="socialInsuranceType" class="form-select">
                            <option value="amount">قيمة</option>
                            <option value="percentage">نسبة %</option>
                        </select>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="socialInsuranceValue" class="form-label fw-bold">القيمة / النسبة</label>
                        <input type="number" step="0.01" class="form-control" id="socialInsuranceValue"
                            placeholder="ادخل القيمة أو النسبة">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إغلاق</button>
                <button type="button" class="btn btn-primary" id="saveSocialInsurance">حفظ</button>
            </div>
        </div>
    </div>
</div>

<style>
    .salary-buttons-bar .btn {
        border-radius: 10px;
        padding: 12px 20px;
        font-weight: 600;
        transition: all 0.3s ease;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .salary-buttons-bar .btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
    }

    .salary-buttons-bar .btn i {
        font-size: 1.1em;
    }

    /* تخصيص الألوان */
    .btn-primary {
        background: linear-gradient(135deg, #007bff, #0056b3);
        border: none;
    }

    .btn-success {
        background: linear-gradient(135deg, #28a745, #1e7e34);
        border: none;
    }

    .btn-info {
        background: linear-gradient(135deg, #17a2b8, #138496);
        border: none;
    }

    .btn-warning {
        background: linear-gradient(135deg, #ffc107, #e0a800);
        border: none;
        color: #212529;
    }

    .btn-danger {
        background: linear-gradient(135deg, #dc3545, #c82333);
        border: none;
    }

    .btn-secondary {
        background: linear-gradient(135deg, #6c757d, #545b62);
        border: none;
    }
</style>

