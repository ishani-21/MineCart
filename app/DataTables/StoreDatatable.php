<?php

namespace App\DataTables;

use App\Models\Store;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class StoreDatatable extends DataTable
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
         // ->addColumn('action', 'storedatatable.action');
         ->addColumn('action', function ($data) use ($admin) {
            if (request()->is('*admin*')) {
               $result = '<div class="btn-group">';
               if ($admin->can('store_status')) {
                  if ($data->status == 1) {
                     $result .= '<button type="button" class="btn-sm btn-danger mr-sm-2 mb-1 changeStatus" status="0" title="click to Active" category_id="' . $data->id . '"><i class="fa fa-lock" aria-hidden="true"></i></button>';
                  } else {
                     $result .= '<button type="button" class="btn-sm btn-success mr-sm-2 mb-1 changeStatus" status="1" title="click to Inactive" category_id="' . $data->id . '"><i class="fa fa-unlock" aria-hidden="true"></i></button>';
                  }
                  $result .= '<div class="btn-group dropdown mr-2 mb-1">';
                  // 0 - pending, 1 - approve, 2 - rejected
                  if ($data->is_approve == 0) {
                     $result .= '<button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Pending <i class="fa fa-question-circle"></i></button>';
                  } else if ($data->is_approve == 1) {
                     $result .= '<button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Approve <i class="fa fa-question-circle"></i></button>';
                  } else {
                     $result .= '<button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Rejected <i class="fa fa-question-circle"></i></button>';
                  }
                  $result .= '<div class="dropdown-menu" data-id="' . $data->id . '">
                        <a class="dropdown-item approve" data-id="' . $data->id . '" is_approve="0">Pending<i class="fa fa-exclamation-triangle float-right"></i></a>
                        <a class="dropdown-item approve" data-id="' . $data->id . '" is_approve="1">Approve<i class="fa fa-check float-right"></i></a>
                        <a class="dropdown-item approve" data-id="' . $data->id . '" is_approve="2">Rejected<i class="fa fa-times float-right"></i></a>
                           </div>
                     </div>';
               }
               $result .= '<a href="' . route('admin.store.show', $data->id) . '"><button type="submit" data-id="' . $data->id . '" class="btn-sm btn-warning mr-sm-2 mb-1 show" title="store show"><i class="fa fa-eye" aria-hidden="true"></i></button></a>';

               if ($admin->can('store_delete')) {
                  $result .= '<button type="submit" data-id="' . $data->id . '" class="btn-sm btn-danger mr-sm-2 mb-1 delete" title="store delete"><i class="fa fa-trash" aria-hidden="true"></i></button>';
               }
               return $result;
            } else {
               $result = '<div class="btn-group">';
               $result .= '<a href="' . route('seller.show_store', $data->id) . '"><button class="btn-sm btn-warning mr-sm-2 mb-1" title="store view"><i class="fa fa-eye" aria-hidden="true"></i></button></a>';
               $result .= '<a href="' . route('seller.edit_store', $data->id) . '"><button class="btn-sm btn-primary mr-sm-2 mb-1" title="store update"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button></a>';
               $result .= '<button type="submit" data-id="' . $data->id . '" class="btn-sm btn-danger mr-sm-2 mb-1 delete" title="store delete" ><i class="fa fa-trash" aria-hidden="true"></i></>';
               return $result;
            }
         })
         ->editColumn('status', function ($data) {
            if (request()->is('*admin*')) {
               if ($data['status'] == '0') {
                  return '<span data-id="' . $data->id . '" class="badge badge-pill-lg badge-success">Active</span>';
               } else {
                  return '<span data-id="' . $data->id . '" class="badge badge-pill-lg badge-danger">Inactive</span>';
               }
            } else {
               if ($data['status'] == '0') {
                  return '<button type="button" data-id="' . $data->id . '" class="badge badge-pill-lg badge-success status">Active</button>';
               } else {
                  return '<button type="button" data-id="' . $data->id . '" class="badge badge-pill-lg badge-danger status">Inactive</button>';
               }
            }
         })

         ->editColumn('is_approve', function ($data) {
            if (request()->is('*admin*')) {
               if ($data['is_approve'] == '0') {
                  return '<span class="badge badge-pill-lg badge-secondary">Pending<span class="badge badge-secondary"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i></span></span>';
               } elseif ($data['is_approve'] == '1') {
                  return '<span class="badge badge-pill-lg badge-success">Approve<span class="badge badge-success"><i class="fa fa-check" aria-hidden="true"></i></span></span>';
               } else {
                  return '<span class="badge badge-pill-lg badge-danger">Rejected<span class="badge badge-danger"><i class="fa fa-times" aria-hidden="true"></i></span></span>';
               }
            } else {
               if ($data['is_approve'] == '0') {
                  return '<button type="button" class="badge badge-pill-lg badge-secondary approve"><b>Pending</b></button>';
               } elseif ($data['is_approve'] == '1') {
                  return '<button type="button" class="badge badge-pill-lg badge-success"><b>Approve</b></button>';
               } else {
                  return '<button type="button" class="badge badge-pill-lg badge-danger"><b>Rejected</b></button>';
               }
            }
         })

         ->editColumn('en_name', function ($data) {
            if (request()->is('*admin*')) {
               return '' . $data->en_name;
            } else {
               return '<a href="' . route('seller.show_store', $data->id) . '" class="text-decoration-none">' . $data->en_name . '</a>';
            }
         })
         ->rawColumns(['action', 'status', 'en_name', 'is_approve'])
         ->addIndexColumn();
   }

   /**
    * Get query source of dataTable.
    *
    * @param \App\Models\StoreDatatable $model
    * @return \Illuminate\Database\Eloquent\Builder
    */
   public function query(Store $model, Request $request)
   {
      if ($request->query('id')) {
         return $model->where('saller_id', decryptString($request->id))->newQuery();
      } else if (request()->is('*seller*')) {
         return $model->where('saller_id', Auth::guard('seller')->user()->id)->newQuery();
      } else {
         return $model->newQuery();
      }
   }

   /**
    * Optional method if you want to use html builder.
    *
    * @return \Yajra\DataTables\Html\Builder
    */
   public function html()
   {
      return $this->builder()
         ->setTableId('storedatatable-table')
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
         Column::make('en_name')->title('Store Name'),
         Column::make('email'),
         Column::make('status'),
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
      return 'Store_' . date('YmdHis');
   }
}
