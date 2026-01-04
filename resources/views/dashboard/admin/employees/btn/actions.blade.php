<div class="d-flex justify-content-center">
    <a href="
        {{ Route::currentRouteName() === 'admin.employees.status'
            ? route('admin.employees.status.show', $employee->id)
            : route('admin.employee.show', $employee->id)
        }}" class="btn btn-sm btn-info">
        <i class="fa fa-eye"></i> عرض
    </a>
</div>
