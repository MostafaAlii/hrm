<?php
namespace App\DataTables\Dashboard\Admin;
use App\DataTables\Base\BaseDataTable;
use App\Models\Religion;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Utilities\Request as DataTableRequest;
class ReligionDataTable extends BaseDataTable {
    public function __construct(DataTableRequest $request)
    {
        parent::__construct(new Religion);
        $this->request = $request;
    }

    public function dataTable($query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function (Religion $religion) {
                return view('dashboard.admin.religion.btn.actions', compact('religion'));
            })
            ->editColumn('is_active_label', function (Religion $religion) {
                return $religion->is_active_label;
            })
            ->editColumn('created_at', function (Religion $religion) {
                return $this->formatTranslatedDate($religion->created_at);
            })
            ->editColumn('updated_at', function (Religion $religion) {
                return $this->formatTranslatedDate($religion->updated_at);
            })
            ->addColumn('responsible', function (Religion $religion) {
                $addedBy   = $religion->addedBy?->name ? "✍️ " . $religion->addedBy->name : null;
                $updatedBy = $religion->updatedBy?->name ? "📝 " . $religion->updatedBy->name : null;
                return $addedBy || $updatedBy ? implode(' | ', array_filter([$addedBy, $updatedBy])) : '-';
            })
            ->rawColumns(['action', 'is_active_label', 'responsible', 'created_at', 'updated_at']);
    }

    public function query(): QueryBuilder
    {
        $user = get_user_data()?->company_id;
        return Religion::where('company_id', $user)->latest();
    }

    public function getColumns(): array
    {
        return [
            ['name' => 'id', 'data' => 'id', 'title' => '#'],
            ['name' => 'name', 'data' => 'name', 'title' => trans('dashboard/religion.name')],
            ['name' => 'is_active', 'data' => 'is_active_label', 'title' => trans('dashboard/financial_year.is_active'), 'orderable' => false, 'searchable' => false],
            ['name' => 'responsible', 'data' => 'responsible', 'title' => trans('dashboard/financial_year.responsible'), 'orderable' => false, 'searchable' => false],
            ['name' => 'created_at', 'data' => 'created_at', 'title' => trans('dashboard/general.created_at')],
            ['name' => 'updated_at', 'data' => 'updated_at', 'title' => trans('dashboard/general.updated_at')],
            ['name' => 'action', 'data' => 'action', 'title' => trans('dashboard/general.actions'), 'orderable' => false, 'searchable' => false],
        ];
    }
}