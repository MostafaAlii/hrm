<div class="d-flex justify-content-center">
    {{--رابط العرض--}}
    <a href="{{ route('admin.employee-leave-allocation.show', $emp_record->id) }}" class="btn btn-info btn-sm" __tooltip="{{$emp_record->name_ar}} - عرض التفاصيل" target="_blank">
        <i class="fas fa-eye"></i>
    </a>
</div>
