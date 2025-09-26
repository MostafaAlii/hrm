<?php

namespace App\DataTables\Dashboard\Admin;

use App\DataTables\Base\BaseDataTable;
use App\Models\Occasion;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Utilities\Request as DataTableRequest;

class OccasionDataTable extends BaseDataTable
{
    public function __construct(DataTableRequest $request)
    {
        parent::__construct(new Occasion);
        $this->request = $request;
    }

    public function dataTable($query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function (Occasion $occasion) {
                return view('dashboard.admin.occasions.btn.actions', compact('occasion'));
            })
            ->editColumn('from_date', function (Occasion $occasion) {
                return $occasion->from_date ? $occasion->from_date->translatedFormat('d F Y') : '-';
            })
            ->editColumn('to_date', function (Occasion $occasion) {
                return $occasion->to_date ? $occasion->to_date->translatedFormat('d F Y') : '-';
            })
            ->addColumn('days_count', function (Occasion $occasion) {
                if ($occasion->from_date && $occasion->to_date) {
                    return \Carbon\Carbon::parse($occasion->from_date)
                        ->diffInDays(\Carbon\Carbon::parse($occasion->to_date)) + 1;
                }
                return '-';
            })
            ->editColumn('is_active_label', function (Occasion $occasion) {
                return $occasion->is_active_label;
            })
            ->editColumn('created_at', function (Occasion $occasion) {
                return $this->formatTranslatedDate($occasion->created_at);
            })
            ->editColumn('updated_at', function (Occasion $occasion) {
                return $this->formatTranslatedDate($occasion->updated_at);
            })
            ->addColumn('responsible', function (Occasion $occasion) {
                $addedBy   = $occasion->addedBy?->name ? "✍️ " . $occasion->addedBy->name : null;
                $updatedBy = $occasion->updatedBy?->name ? "📝 " . $occasion->updatedBy->name : null;
                return $addedBy || $updatedBy ? implode(' | ', array_filter([$addedBy, $updatedBy])) : '-';
            })
            ->rawColumns(['action', 'is_active_label', 'responsible', 'created_at', 'updated_at', 'from_date', 'to_date', 'days_count']);
    }

    public function query(): QueryBuilder
    {
        $user = get_user_data()?->company_id;
        return Occasion::where('company_id', $user)->latest();
    }

    public function getColumns(): array
    {
        return [
            ['name' => 'id', 'data' => 'id', 'title' => '#'],
            ['name' => 'name', 'data' => 'name', 'title' => trans('dashboard/occasion.name')],
            ['name' => 'from_date', 'data' => 'from_date', 'title' => 'من تاريخ'],
            ['name' => 'to_date', 'data' => 'to_date', 'title' => 'إلى تاريخ'],
            ['name' => 'days_count', 'data' => 'days_count', 'title' => 'عدد الأيام', 'orderable' => false, 'searchable' => false],
            ['name' => 'is_active', 'data' => 'is_active_label', 'title' => trans('dashboard/financial_year.is_active'), 'orderable' => false, 'searchable' => false],
            ['name' => 'responsible', 'data' => 'responsible', 'title' => trans('dashboard/financial_year.responsible'), 'orderable' => false, 'searchable' => false],
            ['name' => 'created_at', 'data' => 'created_at', 'title' => trans('dashboard/general.created_at')],
            ['name' => 'updated_at', 'data' => 'updated_at', 'title' => trans('dashboard/general.updated_at')],
            ['name' => 'action', 'data' => 'action', 'title' => trans('dashboard/general.actions'), 'orderable' => false, 'searchable' => false],
        ];
    }
}