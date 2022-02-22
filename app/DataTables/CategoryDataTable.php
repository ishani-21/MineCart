<?php

namespace App\DataTables;

use App\Models\Category;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class CategoryDataTable extends DataTable
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
            // ->addColumn('action', 'category.action')
            ->addColumn('action', function ($data) use ($admin) {
                $result = '<div class="btn-group">';
                if ($admin->can('category_status')) {
                    if ($data->status == 1) {
                        $result .= '<button type="button" class="btn-sm btn-danger mr-sm-2 mb-1 changeStatus" status="0" title="click to Active" data-id="' . $data->id . '"><i class="fa fa-lock" aria-hidden="true"></i></button>';
                    } else {
                        $result .= '<button type="button" class="btn-sm btn-success mr-sm-2 mb-1 changeStatus" status="1" title="click to Inactive" data-id="' . $data->id . '"><i class="fa fa-unlock" aria-hidden="true"></i></button>';
                    }
                }
                if ($admin->can('category_view')) {
                    $result .= '<a  href=' . route("admin.Category.categoryshow", $data->slug) . '><button class="btn-sm btn-warning mr-sm-2 mb-1"  title="Show Category Details"><i class="fa ft-eye" aria-hidden="true"></i></button></a>';
                }
                if ($admin->can('category_update')) {
                    $result .= '<a  href=' . route("admin.Category.categoryedit", $data->slug) . '><button class="btn-sm btn-info mr-sm-2 mb-1"  title="Edit Brand Details"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button></a>';
                }
                if ($admin->can('category_delete')) {
                    $result .= '<button data-id="' . $data->id . '" class="btn-sm btn-danger mr-sm-2 mb-1 delete" title="Delete Category Details"><i class="fa fa-trash" aria-hidden="true"></i></button></a>';
                }
                return $result;
            })
            ->editColumn('image', function ($data) {
                return '<img src="' . asset('' . $data->image) . '" width="50px"></img>';
            })
            ->editColumn('status', function ($data) {
                if ($data->status == "0") {
                    return '<span class="badge badge-pill-lg badge-success">Active</span>';
                } else {
                    return '<span class="badge badge-pill-lg badge-danger">Inactive</span>';
                }
            })
            ->rawColumns(['action', 'image', 'status'])
            ->addIndexColumn();
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Category $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Category $model)
    {
        return $model->where('parent_id', '0')->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('category-table')
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
            Column::make('id')->data('DT_RowIndex'),
            Column::make('en_name')->title('name'),
            Column::make('image'),
            Column::make('status'),
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
        return 'Category_' . date('YmdHis');
    }
}
