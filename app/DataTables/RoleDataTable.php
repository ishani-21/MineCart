<?php

namespace App\DataTables;

use App\Models\Role;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class RoleDataTable extends DataTable
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
                if ($admin->can('role_update')) {
                    $result .= '<a href="' . url('admin/role/edit/' . $data->id) . '" ><button class="btn-sm btn-primary mr-sm-2 mb-1" title="Edit Role"><i class="fa fa-edit" aria-hidden="true"></i></button></a>&nbsp;';
                }
                if ($admin->can('role_delete')) {
                    $result .= '<button type="button" id="cat_delete" class="btn-sm btn-danger mr-sm-2 mb-1" title="delete Role" category_id="' . $data->id . '"><i class="fa fa-trash" aria-hidden="true"></i></button></div> ';
                }
                return $result;
            })

            ->rawColumns(['action'])
            ->addIndexColumn();
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Role $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Role $model)
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
            ->setTableId('role-table')
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
            Column::make('name')->title('Role Name'),
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
        return 'Role_' . date('YmdHis');
    }
}
