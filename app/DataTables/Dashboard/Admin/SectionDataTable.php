<?php

namespace App\DataTables\Dashboard\Admin;

use App\DataTables\Base\BaseDataTable;
use App\Models\{Section,Department};
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Utilities\Request as DataTableRequest;

class SectionDataTable extends BaseDataTable
{
    public function __construct(DataTableRequest $request)
    {
        parent::__construct(new Section);
        $this->request = $request;
    }

    public function dataTable($query): EloquentDataTable
    {
        $departments = Department::active()->get();
        return (new EloquentDataTable($query))
            ->addColumn('action', function (Section $section) use ($departments) {
                return view('dashboard.admin.section.btn.actions', compact(['section', 'departments']));
            })
            ->editColumn('is_active_label', function (Section $section) {
                return $section->is_active_label;
            })
            ->editColumn('created_at', function (Section $section) {
                return $this->formatTranslatedDate($section->created_at);
            })
            ->editColumn('updated_at', function (Section $section) {
                return $this->formatTranslatedDate($section->updated_at);
            })
            ->editColumn('department_id', function (Section $section) {
                return $section->department?->name ? "📝 " . $section->department->name : null;
            })
            ->addColumn('responsible', function (Section $section) {
                $addedBy   = $section->addedBy?->name ? "✍️ " . $section->addedBy->name : null;
                $updatedBy = $section->updatedBy?->name ? "📝 " . $section->updatedBy->name : null;
                return $addedBy || $updatedBy ? implode(' | ', array_filter([$addedBy, $updatedBy])) : '-';
            })
            ->rawColumns(['action', 'is_active_label', 'responsible', 'created_at', 'updated_at', 'department_id']);
    }

    public function query(): QueryBuilder
    {
        $user = get_user_data()?->company_id;
        return Section::with(['department'])->where('company_id', $user)->latest();
    }

    public function getColumns(): array
    {
        return [
            ['name' => 'id', 'data' => 'id', 'title' => '#'],
            ['name' => 'name', 'data' => 'name', 'title' => trans('dashboard/branch.name')],
            ['name' => 'is_active', 'data' => 'is_active_label', 'title' => trans('dashboard/financial_year.is_active'), 'orderable' => false, 'searchable' => false],
            ['name' => 'responsible', 'data' => 'responsible', 'title' => trans('dashboard/financial_year.responsible'), 'orderable' => false, 'searchable' => false],
            ['name' => 'department_id', 'data' => 'department_id', 'title' => trans('dashboard/section.department_name'), 'orderable' => false, 'searchable' => false],
            ['name' => 'created_at', 'data' => 'created_at', 'title' => trans('dashboard/general.created_at')],
            ['name' => 'updated_at', 'data' => 'updated_at', 'title' => trans('dashboard/general.updated_at')],
            ['name' => 'action', 'data' => 'action', 'title' => trans('dashboard/general.actions'), 'orderable' => false, 'searchable' => false],
        ];
    }
}
