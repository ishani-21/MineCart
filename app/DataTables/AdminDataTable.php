<?php

namespace App\DataTables;

use App\Models\Admin;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class AdminDataTable extends DataTable
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
                if($admin->can('admin_update'))
                {
                    $result .= '<a><button class="btn-sm btn-primary mr-sm-2 mb-1"  title="Edit Admin User Details" data-toggle="modal" data-target="#edit_adminuser_modal"  data-id="' . $data->id . '" ><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button></a>&nbsp;';
                }
                if($admin->can('admin_delete'))
                {
                    $result .= '<button type="button" id="delete" title="Delete Admin User Details" class="btn-sm btn-danger mr-sm-2 mb-1" category_id="' . $data->id . '" ><i class="fa fa-trash" aria-hidden="true"></i></button></div>';
                }
                return $result;
            })
            ->rawColumns(['action'])
            ->addIndexColumn();
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Admin $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Admin $model)
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
                    ->setTableId('admin-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Blfrtip')
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
            Column::make('name'),
            Column::make('email'),
            Column::make('assign_role'),
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
        return 'Admin_' . date('YmdHis');
    }
}

// DB_CONNECTION=mysql
// DB_HOST=192.168.0.47
// DB_PORT=3306
// DB_DATABASE=university
// DB_USERNAME=university
// DB_PASSWORD=a7@$^&*l2uqRrrlV34P5p