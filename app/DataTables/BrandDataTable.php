<?php

namespace App\DataTables;

use App\Models\Brand;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class BrandDataTable extends DataTable
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
                if ($admin->can('brand_status')) {
                    if ($data->status == 1) {
                        $result .= '<button type="button" class="btn-sm btn-danger mr-sm-2 mb-1 changeStatus" status="0" title="click to Activate" category_id="' . $data->id . '"><i class="fa fa-lock" aria-hidden="true"></i></button>';
                    } else {
                        $result .= '<button type="button" class="btn-sm btn-success mr-sm-2 mb-1 changeStatus" status="1" title="click to Inactivate" category_id="' . $data->id . '"><i class="fa fa-unlock" aria-hidden="true"></i></button>';
                    }
                }
                if ($admin->can('brand_update')) {
                    $result .= '<a  href=' . route("admin.Brand.edit", $data->id) . '><button class="btn-sm btn-primary mr-sm-2 mb-1"  title="Edit Brand Details"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button></a>&nbsp;';
                }
                if ($admin->can('brand_delete')) {
                    $result .= '<button type="button" id="cat_delete" title="Delete Brand Details" class="btn-sm btn-danger mr-sm-2 mb-1" category_id="' . $data->id . '" ><i class="fa fa-trash" aria-hidden="true"></i></button></div>';
                }
                return $result;
            })

            ->editColumn('status', function ($data) {
                if ($data->status == 0) {
                    return '<span class="badge badge-pill-lg badge-success">Active</span>';
                } else {
                    return '<span class="badge badge-pill-lg badge-danger">Inactive</span>';
                }
            })

            ->editColumn('image', function ($data) {
                return '<img src="' . $data->image . '" width="50px"></img>';
            })

            ->rawColumns(['action', 'image', 'status'])
            ->addIndexColumn();
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Brand $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Brand $model)
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
            ->setTableId('brand-table')
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
            Column::make('en_name')->title('Brand Name'),
            Column::make('image')->title('Brand Logo'),
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
        return 'Brand_' . date('YmdHis');
    }
}
