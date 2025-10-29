<?php
namespace App\Http\Controllers\Dashboard\Reports;
use App\Http\Controllers\Controller;
use App\Models\Employee;
use Illuminate\Http\Request;
use App\Filters\EmployeeReport\EmployeeReportFilter;
class EmployeeReportController extends Controller {
    public function index() {
        /**
         * personnel_affairs -> تقرير شئون العاملين
         * employee_data -> تقرير بيانات الموظفين
         */
        return view('dashboard.admin.reports.personnel_affairs.employee_data.index');
    }

    public function filter(Request $request) {
        $query = Employee::query();
        $filter = new EmployeeReportFilter($request, $query);
        $employees = $filter->apply()->get();
        return view('dashboard.admin.reports.personnel_affairs.employee_data.index', compact('employees'));
    }
}
