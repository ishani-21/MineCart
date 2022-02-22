<?php

namespace App\DataTables;

use App\Models\Membership;
use App\Models\MembershipPlan;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class MembershipDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        $admin = Auth()->guard('admin')->user();
        return datatables()
            ->eloquent($query)
            ->addColumn('action', function ($data) use ($admin) {
                $result = '<div class="btn-group">';
                if ($admin->can('membership_status')) {
                    if ($data->status == 1) {
                        $result .= '<button type="button" class="btn-sm btn-danger mr-sm-2 mb-1 changeStatus" status="0" title="click to Approve" category_id="' . $data->id . '"><i class="fa fa-lock" aria-hidden="true"></i></button>';
                    } else {
                        $result .= '<button type="button" class="btn-sm btn-success mr-sm-2 mb-1 changeStatus" status="1" title="click to Rejected" category_id="' . $data->id . '"><i class="fa fa-unlock" aria-hidden="true"></i></button>';
                    }
                }
                if ($admin->can('membership_update')) {
                    $result .= '<a><button class="btn-sm btn-primary mr-sm-2 mb-1" title="Edit Membership Plan" data-toggle="modal" data-target="#membership_edit_modal" data-id="' . $data->id . '"><i class="fa fa-edit" aria-hidden="true"></i></button></a>&nbsp;';
                }
                if ($admin->can('membership_delete')) {
                    $result .= '<a><button class="btn-sm btn-danger mr-sm-2 mb-1" id="cat_delete" title="Delete Membership Plan" category_id="' . $data->id . '"><i class="fa fa-trash" aria-hidden="true"></i></button></a>&nbsp;';
                }
                return $result;
            })

            ->editColumn('status', function ($data) {
                if ($data->status == 0) {
                    return '<span class="badge badge-pill-lg badge-success">Approve</span>';
                } else {
                    return '<span class="badge badge-pill-lg badge-danger">Rejected</span>';
                }
            })

            ->rawColumns(['action', 'status'])
            ->addIndexColumn();
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\MembershipPlan $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(MembershipPlan $model)
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('membership-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('Bfrtip')
            ->orderBy(1)
            ->buttons(
                Button::make('create'),
                Button::make('export'),
                Button::make('print'),
                Button::make('reset'),
                Button::make('reload')
            );
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            Column::make('no')->data('DT_RowIndex')->searchable(false)->orderable(false),
            Column::make('id')->hidden(),
            Column::make('en_package_name')->title('Package Name'),
            Column::make('price')->title('Price'),
            Column::make('duration')->title('Duration'),
            Column::make('en_discription')->title('Discription'),
            Column::make('status')->title('Status'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-center'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Membership_' . date('YmdHis');
    }
}
