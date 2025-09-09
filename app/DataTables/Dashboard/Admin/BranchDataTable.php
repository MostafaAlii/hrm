<?php

namespace App\DataTables\Dashboard\Admin;

use App\DataTables\Base\BaseDataTable;
use App\Models\Branch;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Utilities\Request as DataTableRequest;

class BranchDataTable extends BaseDataTable
{
    public function __construct(DataTableRequest $request)
    {
        parent::__construct(new Branch);
        $this->request = $request;
    }

    public function dataTable($query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function (Branch $branch) {
                return view('dashboard.admin.branches.btn.actions', compact('branch'));
            })
            ->editColumn('is_active_label', function (Branch $branch) {
                return $branch->is_active_label;
            })
            ->editColumn('created_at', function (Branch $branch) {
                return $this->formatTranslatedDate($branch->created_at);
            })
            ->editColumn('updated_at', function (Branch $branch) {
                return $this->formatTranslatedDate($branch->updated_at);
            })
            ->addColumn('responsible', function (Branch $branch) {
                $addedBy   = $branch->addedBy?->name ? "✍️ " . $branch->addedBy->name : null;
                $updatedBy = $branch->updatedBy?->name ? "📝 " . $branch->updatedBy->name : null;
                return $addedBy || $updatedBy ? implode(' | ', array_filter([$addedBy, $updatedBy])) : '-';
            })
            ->rawColumns(['action', 'is_active_label','responsible', 'created_at', 'updated_at']);
    }

    public function query(): QueryBuilder
    {
        $user = get_user_data()?->company_id;
        return Branch::where('company_id', $user)->latest();
    }

    public function getColumns(): array
    {
        return [
            ['name' => 'id', 'data' => 'id', 'title' => '#'],
            ['name' => 'name', 'data' => 'name', 'title' => trans('dashboard/branch.name')],
            ['name' => 'is_active', 'data' => 'is_active_label', 'title' => trans('dashboard/financial_year.is_active')],
            ['name' => 'phone', 'data' => 'phone', 'title' => trans('dashboard/branch.phone')],
            ['name' => 'responsible', 'data' => 'responsible', 'title' => trans('dashboard/financial_year.responsible')],
            ['name' => 'created_at', 'data' => 'created_at', 'title' => trans('dashboard/general.created_at')],
            ['name' => 'updated_at', 'data' => 'updated_at', 'title' => trans('dashboard/general.updated_at')],
            ['name' => 'action', 'data' => 'action', 'title' => trans('dashboard/general.actions'), 'orderable' => false, 'searchable' => false],
        ];
    }
}