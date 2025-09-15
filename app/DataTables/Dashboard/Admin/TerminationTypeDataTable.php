<?php

namespace App\DataTables\Dashboard\Admin;

use App\DataTables\Base\BaseDataTable;
use App\Models\TerminationType;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Utilities\Request as DataTableRequest;

class TerminationTypeDataTable extends BaseDataTable
{
    public function __construct(DataTableRequest $request)
    {
        parent::__construct(new TerminationType);
        $this->request = $request;
    }

    public function dataTable($query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function (TerminationType $terminationType) {
                return view('dashboard.admin.terminationTypes.btn.actions', compact('terminationType'));
            })
            ->editColumn('is_active_label', function (TerminationType $terminationType) {
                return $terminationType->is_active_label;
            })
            ->editColumn('created_at', function (TerminationType $terminationType) {
                return $this->formatTranslatedDate($terminationType->created_at);
            })
            ->editColumn('updated_at', function (TerminationType $terminationType) {
                return $this->formatTranslatedDate($terminationType->updated_at);
            })
            ->addColumn('responsible', function (TerminationType $terminationType) {
                $addedBy   = $terminationType->addedBy?->name ? "✍️ " . $terminationType->addedBy->name : null;
                $updatedBy = $terminationType->updatedBy?->name ? "📝 " . $terminationType->updatedBy->name : null;
                return $addedBy || $updatedBy ? implode(' | ', array_filter([$addedBy, $updatedBy])) : '-';
            })
            ->rawColumns(['action', 'is_active_label', 'responsible', 'created_at', 'updated_at']);
    }

    public function query(): QueryBuilder
    {
        $user = get_user_data()?->company_id;
        return TerminationType::where('company_id', $user)->latest();
    }

    public function getColumns(): array
    {
        return [
            ['name' => 'id', 'data' => 'id', 'title' => '#'],
            ['name' => 'name', 'data' => 'name', 'title' => trans('dashboard/branch.name')],
            ['name' => 'is_active', 'data' => 'is_active_label', 'title' => trans('dashboard/financial_year.is_active'), 'orderable' => false, 'searchable' => false],
            ['name' => 'responsible', 'data' => 'responsible', 'title' => trans('dashboard/financial_year.responsible'), 'orderable' => false, 'searchable' => false],
            ['name' => 'created_at', 'data' => 'created_at', 'title' => trans('dashboard/general.created_at')],
            ['name' => 'updated_at', 'data' => 'updated_at', 'title' => trans('dashboard/general.updated_at')],
            ['name' => 'action', 'data' => 'action', 'title' => trans('dashboard/general.actions'), 'orderable' => false, 'searchable' => false],
        ];
    }
}