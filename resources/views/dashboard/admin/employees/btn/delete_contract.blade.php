<td>
    <!-- زرار حذف -->
    <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
        data-bs-target="#deleteContractModal{{ $contract->id }}">
        <i class="fas fa-trash"></i>
    </button>

    <!-- Delete Modal -->
    <div class="modal fade" id="deleteContractModal{{ $contract->id }}" tabindex="-1"
        aria-labelledby="deleteContractLabel{{ $contract->id }}" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteContractLabel{{ $contract->id }}">تأكيد الحذف</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="إغلاق"></button>
                </div>
                <div class="modal-body text-center">
                    <p>هل أنت متأكد من حذف العقد <strong>{{ $contract->contractType?->name_ar }}</strong> ؟</p>
                    <p class="text-danger">هذا الإجراء لا يمكن التراجع عنه.</p>
                </div>
                <div class="modal-footer">
                    <form action="{{ route('admin.employees.contracts.destroy', [$record->id, $contract->id]) }}"
                        method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إلغاء</button>
                        <button type="submit" class="btn btn-danger">نعم، حذف</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</td>
