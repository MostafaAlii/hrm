<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Eloquents\EmployeeRepository;
use App\DataTables\Dashboard\Admin\EmployeeDataTable;
use App\Models\{Employee, EmployeeStatus};
use App\Core\EmployeeStatus\EmployeeStatusTabManager;
class EmployeeStatusController extends Controller {
    protected $repository;
    public function __construct(EmployeeRepository $repository) {
        $this->repository = $repository;
    }

    public function __invoke(EmployeeDataTable $dataTable) {
        return $this->repository->index(
            $dataTable,
            'dashboard.admin.employees.index',
            'تعديل الحالة للموظفين'
        );
    }

    public function show(Employee $employee) {
        $title = trans('dashboard/sidebar.employee_status_title');
        $tabs = EmployeeStatusTabManager::all();
        $history = [];
        foreach ($tabs as $tab) {
            $history[$tab->key()] = $employee->statuses()
                ->where('type', $tab->key())
                ->orderBy('effective_date', 'desc')
                ->get();
        }
        return view(
            'dashboard.admin.employees.btn.status.show',
            compact(['employee', 'title', 'tabs', 'history'])
        );
    }

    public function store(Request $request, Employee $employee) {
        $tabKey = $request->input('tab');
        $tab = collect(EmployeeStatusTabManager::all())->first(fn($t) => $t->key() === $tabKey);
        abort_if(!$tab, 404);
        $request->validate([
            'to_id'          => 'required|integer',
            'effective_date' => 'required|date',
            'reason'         => 'nullable|string|max:255',
            'notes'          => 'nullable|string',
        ]);
        $fromName = $tab->from($employee);
        $toModel = collect($tab->options())->firstWhere('id', (int) $request->to_id);
        abort_if(!$toModel, 422);
        $status = EmployeeStatus::create([
            'employee_type' => get_class($employee),
            'employee_id'   => $employee->id,
            'type' => $tab->key(),
            'changeable_type' => $tab->model(),
            'changeable_id'   => $toModel->id,
            'from_id'   => optional($employee->{$tab->key()})->id,
            'to_id'     => $toModel->id,
            'name_from' => $fromName,
            'name_to'   => $toModel->name,
            'effective_date' => $request->effective_date,
            'reason'         => $request->reason,
            'notes'          => $request->notes,
        ]);
        event(new \App\Events\EmployeeStatusChanged($status));
        return redirect()->route('admin.employees.status.show', $employee->id)->with('success', __('تم حفظ التعديل بنجاح'));
    }
}