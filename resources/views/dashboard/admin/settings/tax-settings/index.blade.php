@extends('dashboard.layouts.master')
@section('css')
<style>
    .bootstrap-switch .switch-group label {
        font-size: 12px !important;
        padding: 2px 6px !important;
    }
</style>
@endsection

@section('title')
{{ $title }}
@endsection
@section('content')
<div class="page-content">
    <div class="content-header">
        <h1 class="mb-0">{{ $title }}</h1>
        <ul class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{route('admin.dashboard')}}">{{trans('dashboard/header.main_dashboard') }}</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{route('admin.tax-settings.index')}}">{{ $title }}</a>
            </li>
        </ul>
    </div>
    <!-- Start Content -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <span class="nav-icon">
                        <i class="ti ti-layout-2"></i>
                    </span>
                     {{ $title }}
                </div>
                <div class="card-body">
                    <form action="{{ isset($taxSetting) && $taxSetting->id
                                        ? route('admin.tax-settings.update', $taxSetting->id)
                                        : route('admin.tax-settings.store') }}" method="POST" class="gap-4 d-flex align-items-center">

                        @csrf
                        @if(isset($taxSetting) && $taxSetting->id)
                        @method('PUT')
                        @endif

                        <!-- Checkbox -->
                        <div class="mb-0 form-check form-switch">
                            <input class="form-check-input" type="checkbox" name="recalculate_taxes" id="recalculate_taxes" value="1" {{
                                old('recalculate_taxes', $taxSetting->recalculate_taxes ?? false) ? 'checked' : '' }}>
                            <label class="form-check-label ms-2" for="recalculate_taxes">
                                إعادة حساب الضرائب
                            </label>
                        </div>

                        <!-- Input مع الليبل جمبه -->
                        <div class="d-flex align-items-center">
                            <label for="tax_exemption_limit" class="mb-0 form-label me-2">
                                حد الإعفاء الضريبي <span class="text-danger">*</span>
                            </label>
                            <input type="number" name="tax_exemption_limit" id="tax_exemption_limit" class="w-auto form-control" step="0.01"
                                min="0" value="{{ old('tax_exemption_limit', $taxSetting->tax_exemption_limit ?? 0) }}" required>
                        </div>

                        <!-- زرار -->
                        <div>
                            <button type="submit" class="btn btn-primary">
                                {{ isset($taxSetting) && $taxSetting->id ? 'تحديث' : 'حفظ' }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            @if(isset($taxSetting) && $taxSetting->id)
            <div class="mt-4 card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 card-title">الشرائح الضريبية</h5>
                    <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal"
                        data-bs-target="#createTaxBracketModal">
                        <i class="fa fa-plus"></i> إضافة شريحة
                    </button>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>الشريحة الضريبية</th>
                                    <th>القيمة</th>
                                    <th>النسبة</th>
                                    <th>نسبة الخصم</th>
                                    <th>المستوى</th>
                                    <th>الإجراءات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($taxBrackets as $bracket)
                                <tr>
                                    <td>{{ $bracket->bracket_name }}</td>
                                    <td>{{ number_format($bracket->value, 2) }}</td>
                                    <td>{{ $bracket->percentage }}%</td>
                                    <td>{{ $bracket->discount_percentage }}%</td>
                                    <td>المستوى {{ $bracket->level }}</td>
                                    <td>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-sm btn-warning" data-bs-toggle="modal"
                                                data-bs-target="#editTaxBracketModal{{ $bracket->id }}">
                                                <i class="fa fa-edit"></i>
                                            </button>
                                            <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                                data-bs-target="#deleteTaxBracketModal{{ $bracket->id }}">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="text-center">لا توجد شرائح ضريبية</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
    <!-- End Content -->
</div>
@if(isset($taxSetting) && $taxSetting->id)
<div class="modal fade" id="createTaxBracketModal" tabindex="-1" aria-labelledby="createTaxBracketModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createTaxBracketModalLabel">إضافة شريحة ضريبية</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('admin.tax-brackets.store') }}" method="POST">
                @csrf
                <input type="hidden" name="tax_setting_id" value="{{ $taxSetting->id }}">
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">اسم الشريحة <span class="text-danger">*</span></label>
                            <input type="text" name="bracket_name" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">المستوى <span class="text-danger">*</span></label>
                            <select name="level" class="form-select">
                                <option value="">-- اختر --</option>
                                <option value="1">المستوى 1</option>
                                <option value="2">المستوى 2</option>
                                <option value="3">المستوى 3</option>
                                <option value="4">المستوى 4</option>
                                <option value="5">المستوى 5</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">القيمة <span class="text-danger">*</span></label>
                            <input type="number" name="value" class="form-control" step="0.01" min="0" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">النسبة % <span class="text-danger">*</span></label>
                            <input type="number" name="percentage" class="form-control" step="0.01" min="0" max="100"
                                required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">نسبة الخصم % <span class="text-danger">*</span></label>
                            <input type="number" name="discount_percentage" class="form-control" step="0.01" min="0"
                                max="100" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إلغاء</button>
                    <button type="submit" class="btn btn-primary">حفظ</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modals التعديل والحذف لكل شريحة -->
@foreach($taxBrackets as $bracket)
<!-- Modal التعديل -->
<div class="modal fade" id="editTaxBracketModal{{ $bracket->id }}" tabindex="-1"
    aria-labelledby="editTaxBracketModalLabel{{ $bracket->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editTaxBracketModalLabel{{ $bracket->id }}">تعديل الشريحة الضريبية</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('admin.tax-brackets.update', $bracket->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">اسم الشريحة <span class="text-danger">*</span></label>
                            <input type="text" name="bracket_name" class="form-control"
                                value="{{ $bracket->bracket_name }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">المستوى <span class="text-danger">*</span></label>
                            <select name="level" class="form-select">
                                <option value="">-- اختر --</option>
                                <option value="1" {{ $bracket->level == 1 ? 'selected' : '' }}>المستوى 1</option>
                                <option value="2" {{ $bracket->level == 2 ? 'selected' : '' }}>المستوى 2</option>
                                <option value="3" {{ $bracket->level == 3 ? 'selected' : '' }}>المستوى 3</option>
                                <option value="4" {{ $bracket->level == 4 ? 'selected' : '' }}>المستوى 4</option>
                                <option value="5" {{ $bracket->level == 5 ? 'selected' : '' }}>المستوى 5</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">القيمة <span class="text-danger">*</span></label>
                            <input type="number" name="value" class="form-control" value="{{ $bracket->value }}"
                                step="0.01" min="0" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">النسبة % <span class="text-danger">*</span></label>
                            <input type="number" name="percentage" class="form-control"
                                value="{{ $bracket->percentage }}" step="0.01" min="0" max="100" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">نسبة الخصم % <span class="text-danger">*</span></label>
                            <input type="number" name="discount_percentage" class="form-control"
                                value="{{ $bracket->discount_percentage }}" step="0.01" min="0" max="100" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إلغاء</button>
                    <button type="submit" class="btn btn-primary">تحديث</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal الحذف -->
<div class="modal fade" id="deleteTaxBracketModal{{ $bracket->id }}" tabindex="-1"
    aria-labelledby="deleteTaxBracketModalLabel{{ $bracket->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteTaxBracketModalLabel{{ $bracket->id }}">تأكيد الحذف</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('admin.tax-brackets.destroy', $bracket->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <div class="modal-body">
                    <p>هل أنت متأكد من حذف الشريحة: <strong>{{ $bracket->bracket_name }}</strong>؟</p>
                    <p class="text-danger">هذا الإجراء لا يمكن التراجع عنه.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إلغاء</button>
                    <button type="submit" class="btn btn-danger">حذف</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach
@endif
@endsection

@push('js')

@endpush
