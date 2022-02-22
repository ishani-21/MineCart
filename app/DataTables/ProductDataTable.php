<?php

namespace App\DataTables;

use App\Models\Category;
use App\Models\CategoryCommission;
use App\Models\Product;
use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ProductDataTable extends DataTable
{
    public function dataTable($query)
    {
        $admin = Auth()->guard('admin')->user();
        return datatables()
            ->eloquent($query)
            ->addColumn('action', function ($data) use ($admin) {
                $result = '<div class="btn-group">';
                if (request()->is('*admin*')) {

                    if ($admin->can('product_status')) {
                        if ($data->status == "1") {
                            $result .= '<button type="button" class="btn-sm btn-danger mr-sm-2 mb-1 changeStatus" status="0" title="click to Active" data-id="' . $data->id . '"><i class="fa fa-lock" aria-hidden="true"></i></button>';
                        } else {
                            $result .= '<button type="button" class="btn-sm btn-success mr-sm-2 mb-1 changeStatus" status="1" title="click to Inactive" data-id="' . $data->id . '"><i class="fa fa-unlock" aria-hidden="true"></i></button>';
                        }
                        $result .= '<div class="btn-group dropdown mr-2 mb-1">';

                        // 0 - pending, 1 - approve, 2 - rejected
                        if ($data->is_approve == 0) {
                            $result .= '<button type="button" class="btn btn-secondary btn-sm dropdown-toggle approve" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Pending <i class="fa fa-question-circle"></i></button>';
                        } else if ($data->is_approve == 1) {
                            $result .= '<button type="button" class="btn btn-success btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Approve <i class="fa fa-question-circle"></i></button>';
                        } else {
                            $result .= '<button type="button" class="btn btn-danger btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Rejected <i class="fa fa-question-circle"></i></button>';
                        }
                        $result .= '<div class="dropdown-menu" data-id="' . $data->id . '">
                          <a class="dropdown-item approve" data-id="' . $data->id . '" is_approve="0">Pending<i class="fa fa-exclamation-triangle float-right"></i></a>
                          <a class="dropdown-item approve" data-id="' . $data->id . '" is_approve="1">Approve<i class="fa fa-check float-right"></i></a>
                          <a class="dropdown-item approve" data-id="' . $data->id . '" is_approve="2">Rejected<i class="fa fa-times float-right"></i></a>
                            </div>
                        </div>';
                    }
                    if ($admin->can('product_view')) {
                        $result .= '<a  href=' . route("admin.product.show", encryptString($data->id)) . '><button class="btn-sm btn-warning mr-sm-2 mb-1"  title="Show Product Details"><i class="fa ft-eye" aria-hidden="true"></i></button></a>';
                    }
                    if ($admin->can('product_delete')) {
                        $result .= '<button data-id="' . $data->id . '" class="btn-sm btn-danger mr-sm-2 mb-1" id="delete" title="Delete Product Details"><i class="fa fa-trash" aria-hidden="true"></i></button></a>';
                    }
                } else {
                    $result .= '<a href="' . route('seller.product.show', $data->id) . '"><button class="btn-sm btn-warning mr-sm-2 mb-1" ><i class="fa fa-eye show" aria-hidden="true"></i></button></a>';
                    $result .= '<a href="' . route('seller.product.edit', $data->id) . '"><button class="btn-sm btn-primary mr-sm-2 mb-1" ><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button></a>';
                    $result .= '<button type="submit" data-id="' . $data->id . '" class="btn-sm btn-danger mr-sm-2 mb-1 delete"><i class="fa fa-trash" aria-hidden="true"></i></button>';
                }

                return $result;
            })
            ->editColumn('brand_id', function ($data) {
                return $data->Brand->en_name ?? '-';
            })
            ->editColumn('stor_id', function ($data) {
                return $data->stores->en_name ?? '-';
            })
            ->editColumn('categories_id', function ($data) {
                return $data->Category->en_name ?? '-';
            })
            ->editColumn('status', function ($data) {
                if (request()->is('*admin*')) {
                    if ($data->status == '1') {
                        return '<span class="badge badge-pill-sm badge-danger">Inactive</span>';
                    } else {
                        return '<span class="badge badge-pill-sm badge-success">Active</span>';
                    }
                } else {
                    if ($data->status == '1') {
                        return '<a data-id="' . $data->id . '"  style="color:white" class="badge badge-pill-lg badge-danger status">Inactive</a>';
                    } else {
                        return '<a data-id="' . $data->id . '"  style="color:white" width="70px" class="badge badge-pill-lg badge-success status">Active</a>';
                    }
                }
            })
            ->editColumn('is_approve', function ($data) {
                if (request()->is('*admin*')) {
                    if ($data['is_approve'] == '0') {
                        return '<span class="badge badge-pill-lg badge-secondary" style="height: 29px;">Pending<span class="badge badge-secondary"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i></span></span>';
                    } elseif ($data['is_approve'] == '1') {
                        return '<span class="badge badge-pill-lg badge-success" style="height: 29px;">Approve<span class="badge badge-success"><i class="fa fa-check" aria-hidden="true"></i></span></span>';
                    } else {
                        return '<span class="badge badge-pill-lg badge-danger" style="height: 29px;">Rejected<span class="badge badge-danger"><i class="fa fa-times" aria-hidden="true"></i></span></span>';
                    }
                } else {
                    if ($data['is_approve'] == '0') {
                        return '<button type="button" class="btn btn-secondary btn-sm approve"><b>Pending</b></button>';
                    } elseif ($data['is_approve'] == '1') {
                        return '<button type="button" class="btn btn-success btn-sm"><b>Approve</b></button>';
                    } else {
                        return '<button type="button" class="btn btn-danger btn-sm"><b>Rejected</b></button>';
                    }
                }
            })
            ->editColumn('en_productname', function ($data) {
                if (request()->is('*admin*')) {
                    return $data->en_productname;
                } else {
                    return '<a href="' . route('seller.product.show', $data->id) . '" class="text-decoration-none" title="Show Product Details">' . $data->en_productname . '</a>';
                }
            })
            ->rawColumns(['action', 'stor_id', 'cover_image', 'categories_id', 'brand_id', 'status', 'is_approve', 'en_productname'])
            ->addIndexColumn();
    }
    public function query(Product $model, Request $request)
    {
        if (request()->is('*admin*')) {
            return $model->newQuery()->with('stores');
        } else {
            if (isset($request->type)) {
                $model =  $model->where('stor_id', $request->type);
            }
<<<<<<< HEAD
            return $model->where('seller_id', Auth::user()->id)->newQuery()->with('stores')->with('Brand')->with('Category');
=======
            $category_commision = CategoryCommission::where('store_id', $request->type)->first();
            // dd($category_commision);
            $selected_category = explode(',', $category_commision->category_id);
            $category = Category::whereIn('parent_id', $selected_category)->get();
            // dd($category);
            // foreach($category as $categorys){
            // dd($categorys['id']);
            $product = $model->where('seller_id', Auth::user()->id)->where('categories_id',  $selected_category)->with('stores')->with('Brand')->with('Category')->newQuery();
            // ->where('categories_id',  $categorys['id'])
            // }
            return $product;
>>>>>>> e9d8593d43b47bbdb2bee4deb30be1036ef3d8c2
        }
    }
    public function html()
    {
        return $this->builder()
            ->setTableId('product-table')
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
    protected function getColumns()
    {
        return [
            Column::make('id')->data('DT_RowIndex')->addClass('text-center')->orderable(false),
            Column::make('en_productname')->title('Product Name')->addClass('text-center'),
            Column::make('stor_id')->title('Store')->addClass('text-center')->name('stores.en_name'),
            Column::make('categories_id')->title('Category')->name('Category.en_name')->addClass('text-center'),
            Column::make('brand_id')->title('Brand')->name('Brand.en_name')->addClass('text-center'),
            Column::make('status')->addClass('text-center'),
            Column::make('is_approve')->title('Approve')->addClass('text-center'),
            Column::make('action')->addClass('text-center')->width(60),
        ];
    }
    protected function filename()
    {
        return 'Product_' . date('YmdHis');
    }
}
