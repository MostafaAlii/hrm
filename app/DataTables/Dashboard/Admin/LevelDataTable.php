<?php

namespace App\DataTables\Dashboard\Admin;

use App\DataTables\Base\BaseDataTable;
use App\Models\{Level};
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Utilities\Request as DataTableRequest;

class LevelDataTable extends BaseDataTable
{
    public function __construct(DataTableRequest $request)
    {
        parent::__construct(new Level);
        $this->request = $request;
    }

    public function dataTable($query): EloquentDataTable {
        return (new EloquentDataTable($query))
            ->addColumn('action', function (Level $level) {
                return view('dashboard.admin.level.btn.actions', compact(['level']));
            })
            ->editColumn('is_active_label', function (Level $level) {
                return $level->is_active_label;
            })
            ->editColumn('created_at', function (Level $level) {
                return $this->formatTranslatedDate($level->created_at);
            })
            ->editColumn('updated_at', function (Level $level) {
                return $this->formatTranslatedDate($level->updated_at);
            })
            ->addColumn('responsible', function (Level $level) {
                $addedBy   = $level->addedBy?->name ? "✍️ " . $level->addedBy->name : null;
                $updatedBy = $level->updatedBy?->name ? "📝 " . $level->updatedBy->name : null;
                return $addedBy || $updatedBy ? implode(' | ', array_filter([$addedBy, $updatedBy])) : '-';
            })
            ->rawColumns(['action', 'is_active_label', 'responsible', 'created_at', 'updated_at']);
    }

    public function query(): QueryBuilder
    {
        $user = get_user_data()?->company_id;
        return Level::where('company_id', $user)->latest();
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