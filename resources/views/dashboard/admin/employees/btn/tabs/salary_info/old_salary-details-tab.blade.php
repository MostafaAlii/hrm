<div class="tab-pane fade show active" id="salary-details" role="tabpanel" aria-labelledby="salary-details-tab">
    <div class="card">
        <div class="card-header">
            <h5 class="card-title mb-0">إدارة المرتب</h5>
        </div>
        <div class="card-body">
            <!-- Buttons Bar -->
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
                    تأمين متغير
                </button>

                <!-- تأمين ثابت -->
                <button type="button" class="btn btn-secondary btn-lg d-flex align-items-center" data-bs-toggle="modal"
                    data-bs-target="#fixedInsuranceModal">
                    <i class="fa fa-shield me-2"></i>
                    تأمين ثابت
                </button>
            </div>

            <!-- Start Salary Table -->
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
                    <tr style="background-color:#e8f5e9;">
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td><strong>إجمالي الأساسي</strong></td>
                        <td>{{ number_format($record?->total_basic_salary, 2) }}</td>
                    </tr>
                    <tr style="background-color:#e3f2fd;">
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td><strong>إجمالي العلاوة</strong></td>
                        <td>{{ $record?->total_allowances }}</td>
                    </tr>
                    <tr style="background-color:#f1f8e9;">
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td><strong>إجمالي الاستحقاقات</strong></td>
                        <td>{{ $record?->entitlements_sum }}</td>
                    </tr>
                    <tr style="background-color:#fff8e1;">
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td><strong>الإجمالي</strong></td>
                        <td>{{ number_format($record?->total_salary, 2) }}</td>
                    </tr>
                    <tr style="background-color:#ffebee;">
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td><strong>إجمالي الاستقطاعات</strong></td>
                        <td>{{ $record?->total_deductions }} -</td>
                    </tr>
                    <tr style="background-color:#fce4ec;">
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td><strong>إجمالي الضرائب</strong></td>
                        <td>{{ number_format($record->monthly_tax, 2) }}</td>
                    </tr>
                    <tr style="background-color:#e0f2f1;">
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td><strong>إجمالي التأمينات</strong></td>
                        <td></td>
                    </tr>
                    <tr style="background-color:#e0f7fa;">
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td><strong>الصافي</strong></td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
            <!-- End Salary Table -->
        </div>
    </div>
</div>

<!-- Modals -->

<!-- Modal أساسي -->
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
                <p>هنا يمكنك إدارة المكونات الأساسية للمرتب</p>
                <!-- يمكن إضافة محتوى إضافي هنا -->
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
                <p>هنا يمكنك إدارة علاوات الموظفين</p>
                <!-- يمكن إضافة محتوى إضافي هنا -->
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
                <p>هنا يمكنك إدارة استحقاقات الموظفين</p>
                <!-- يمكن إضافة محتوى إضافي هنا -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إغلاق</button>
                <button type="button" class="btn btn-info">حفظ</button>
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
                <p>هنا يمكنك إدارة استقطاعات الموظفين</p>
                <!-- يمكن إضافة محتوى إضافي هنا -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إغلاق</button>
                <button type="button" class="btn btn-warning">حفظ</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal تأمين متغير -->
<div class="modal fade" id="variableInsuranceModal" tabindex="-1" aria-labelledby="variableInsuranceModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="variableInsuranceModalLabel">
                    <i class="fa fa-shield-alt me-2"></i>
                    إدارة التأمين المتغير
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>هنا يمكنك إدارة التأمين المتغير للموظفين</p>
                <!-- يمكن إضافة محتوى إضافي هنا -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إغلاق</button>
                <button type="button" class="btn btn-danger">حفظ</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal تأمين ثابت -->
<div class="modal fade" id="fixedInsuranceModal" tabindex="-1" aria-labelledby="fixedInsuranceModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-secondary text-white">
                <h5 class="modal-title" id="fixedInsuranceModalLabel">
                    <i class="fa fa-shield me-2"></i>
                    إدارة التأمين الثابت
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>هنا يمكنك إدارة التأمين الثابت للموظفين</p>
                <!-- يمكن إضافة محتوى إضافي هنا -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إغلاق</button>
                <button type="button" class="btn btn-dark">حفظ</button>
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
