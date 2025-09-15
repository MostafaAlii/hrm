<div class="d-flex justify-content-center">
    <!-- Edit Button -->
    <a href="{{ route('admin.financialYears.edit', $financialYear->id) }}" data-id="{{ $financialYear->id }}" class="btn btn-primary btn-sm mx-1 edit-financial-year" title="Edit">
        <i class="fas fa-edit"></i> <!-- Font Awesome edit icon -->
    </a>

    <a href="javascript:void(0)" class="btn btn-info btn-sm mx-1 show-financial-year-months"
        data-id="{{ $financialYear->id }}" title="{{ trans('dashboard/general.view_months') }}">
        <i class="fas fa-calendar-alt"></i>
    </a>

    {{--<button type="button" class="mx-1 btn btn-danger btn-sm" data-bs-toggle="modal"
        data-bs-target="#deleteModal{{ $financialYear->id }}">
        <i class="fas fa-trash"></i>
    </button>

    <div class="modal fade" id="deleteModal{{ $financialYear->id }}" tabindex="-1" aria-labelledby="deleteModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">تأكيد الحذف</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="إغلاق"></button>
                </div>
                <div class="text-center modal-body">
                    <p>هل أنت متأكد من حذف "<strong>{{ $financialYear->name }}</strong>"؟</p>
                    <p class="text-danger">هذا الإجراء لا يمكن التراجع عنه.</p>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إلغاء</button>
                        <form action="{{ route('admin.financialYears.destroy', $financialYear->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">نعم، حذف</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>--}}
    @if($financialYear->is_active || $financialYear->start_date->year == now()->year)
    <button type="button" class="mx-1 btn btn-secondary btn-sm" disabled>
        <i class="fas fa-ban"></i>
    </button>
    @else
    <button type="button" class="mx-1 btn btn-danger btn-sm" data-bs-toggle="modal"
        data-bs-target="#deleteModal{{ $financialYear->id }}">
        <i class="fas fa-trash"></i>
    </button>
    
    <div class="modal fade" id="deleteModal{{ $financialYear->id }}" tabindex="-1" aria-labelledby="deleteModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">تأكيد الحذف</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="إغلاق"></button>
                </div>
                <div class="text-center modal-body">
                    <p>هل أنت متأكد من حذف "<strong>{{ $financialYear->name }}</strong>"؟</p>
                    <p class="text-danger">هذا الإجراء لا يمكن التراجع عنه.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إلغاء</button>
                    <form action="{{ route('admin.financialYears.destroy', $financialYear->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">نعم، حذف</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endif
    <div class="modal fade" id="financialYearMonthsModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content"></div>
        </div>
    </div>
    <div class="modal fade" id="editFinancialYearModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content"></div>
        </div>
    </div>
</div>
