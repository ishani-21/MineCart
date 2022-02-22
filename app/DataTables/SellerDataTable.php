<?php

namespace App\DataTables;

use App\Models\Seller;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class SellerDataTable extends DataTable
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

                if ($admin->can('seller_status')) {
                    if ($data->status == 1) {
                        $result .= '<a><button type="button" class="btn-sm btn-danger mr-sm-2 mb-1 status" status="0" title="click to Active" data-id="' . $data->id . '"><i class="fa fa-lock" aria-hidden="true"></i></button></a>';
                    } else {
                        $result .= '<a><button type="button" class="btn-sm btn-success mr-sm-2 mb-1 status" status="1" title="click to Inactive" data-id="' . $data->id . '"><i class="fa fa-unlock" aria-hidden="true"></i></button></a>';
                    }
                    // 0 - pending, 1 - approve, 2 - rejected
                    if ($data->is_approve == 0) {
                        $result .= '<button type="button" class="btn-sm btn-secondary mr-sm-2 mb-1 dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Pending <i class="fa fa-question-circle"></i></button>';
                    } else if ($data->is_approve == 1) {
                        $result .= '<button type="button" class="btn-sm btn-success mr-sm-2 mb-1 dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Approve <i class="fa fa-question-circle"></i></button>';
                    } else {
                        $result .= '<button type="button" class="btn-sm btn-danger mr-sm-2 mb-1 dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Rejected <i class="fa fa-question-circle"></i></button>';
                    }
                    $result .= '<div class="dropdown-menu" data-id="' . $data->id . '">
                            <a class="dropdown-item approve" data-id="' . $data->id . '" is_approve="0">Pending<i class="fa fa-exclamation-triangle float-right"></i></a>
                            <a class="dropdown-item approve" data-id="' . $data->id . '" is_approve="1">Approve<i class="fa fa-check float-right"></i></a>
                            <a class="dropdown-item approve" data-id="' . $data->id . '" is_approve="2">Rejected<i class="fa fa-times float-right"></i></a>
                                </div>
                            ';
                }
                if ($admin->can('seller_view')) {
                    $result .= '<a href=' . route("admin.Seller.view", $data->id) . '><button class="btn-sm btn-warning mr-sm-2 mb-1" title="Show Seller" data-toggle="modal" data-target="#" data-id="' . $data->id . '"><i class="fa fa-eye" aria-hidden="true"></i></button></a>&nbsp;';
                }
                if ($admin->can('store_view')) {
                    $result .= '<a href="' . route("admin.store.index", 'id=' . encryptString($data->id)) . '"><button type="button" data-type="store" id="store" title="Show store for ' . $data->fname . ' ' . $data->lname . '" class="btn-sm btn-secondary mr-sm-2 mb-1" data-id="' . $data->id . '" ><i class="fa fa-shopping-basket" aria-hidden="true"></i></button></a></div>';
                }
                return $result;
            })
            ->editColumn('is_approve', function ($data) {
                if ($data['is_approve'] == '0') {
                    return '<span class="badge badge-pill-lg badge-secondary">Pending <i class="fa fa-exclamation-triangle" aria-hidden="true"></i></span>';
                } elseif ($data['is_approve'] == '1') {
                    return '<span class="badge badge-pill-lg badge-success">Approve <i class="fa fa-check" aria-hidden="true"></i></span>';
                } else {
                    return '<span class="badge badge-pill-lg badge-danger">Rejected <i class="fa fa-times" aria-hidden="true"></i></span>';
                }
            })
            ->editColumn('status', function ($data) {
                if ($data->status == "0") {
                    return '<span class="badge badge-pill-lg badge-success">Active</span>';
                } else {
                    return '<span class="badge badge-pill-lg badge-danger">Inactive</span>';
                }
            })
            ->editColumn('fname', function ($data) {
                return $data->fname ?? '-';
            })
            ->editColumn('lname', function ($data) {
                return $data->lname ?? '-';
            })

            ->rawColumns(['action', 'status', 'fname', 'lname', 'is_approve'])
            ->addIndexColumn();
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Seller $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Seller $model)
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
            ->setTableId('seller-table')
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
            Column::make('fname')->title('First Name'),
            Column::make('lname')->title('Last Name'),
            Column::make('email')->title('Email'),
            Column::make('mobile')->title('Mobile'),
            Column::make('status')->title('Status'),
            Column::make('is_approve')->title('Approve'),
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
        return 'Seller_' . date('YmdHis');
    }
}
