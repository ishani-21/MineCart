@extends('Admin.layouts.master')
@section('title', 'Category')
@push('css')
<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" /> -->
<!-- <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet"> -->
<link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
<style>
html body.layout-dark:not(.layout-transparent) .pagination .page-item .page-link {
    background-color: #1E1E1E;
    border-color: #474748;
}
body.layout-dark .pagination .page-item.active .page-link {
    background-color: #017bff!important;
    border-color: #017bff!important;
}
</style>
@endpush
@section('content')
<div class="content-overlay"></div>
    <div class="content-wrapper">
        <div class="col-12">
            <div class="content-header">List Category</div>
            <p class="content-sub-header mb-1">List category also here.</p>
        </div>
        <hr class="mt-1 mt-sm-2"></br>
        @can('category_create')
        <a href="{{route('admin.Category.categoryview')}}">
            <button class="btn btn-primary mr-sm-2 mb-1"><i class="ft-plus mr-2"></i>Add Category</button></a></br>
        @endcan
        <div class="row">
            <div class="col-12">
                <div class="card m-b-30">
                    <div class="card-header">
                        <div class="card-header-actions">
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="ajax-msg"></div>
                        <div class="table-responsive">
                            {!! $dataTable->table(['class' => 'table table-striped zero-configuration dataTable']) !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.0.3/css/buttons.dataTables.min.css">
{!! $dataTable->scripts() !!}
<script>
    $(document).on('click', '.changeStatus', function() {
        var this_var = this;
        $(this).attr('disabled', true);
        var id = $(this).data('id');
        var status = $(this).attr('status');
        var msg = "";

        if (status == 0) {
            msg = "Active";
        } else {
            msg = "Inactive";
        }

        swal({
            title: 'Are you sure want to ' + msg + '?',
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, ' + msg + ' it!',
            reverseButtons: true
        }).then((result) => {
            if (result) {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "{{ route('admin.Category.catchangestatus') }}",
                    type: 'Post',
                    data: {
                        'id': id
                    },
                    success: function(res) {
                        swal(
                            res.action, //get from controller (block/unblock/cancel)
                            res.msg, // get from controller
                            res.status // get from controller (success/error)
                        )
                        window.LaravelDataTables["category-table"].draw();
                    }
                });
            } else {
                swal("Cancelled", "Status not changed :)", "error");
                $(this).attr('disabled', false);
            }
        }).catch((error) => {
            $('.changeStatus').attr('disabled', false);
        });

    });

    $(document).on('click', '.delete', function() {
        var id = $(this).data('id');
        swal({
            title: 'Are you sure want to delete ?',
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes',
            reverseButtons: true
        }).then((result) => {
            if (result) {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "{{ route('admin.Category.subdelete') }}",
                    type: 'Post',
                    data: {
                        'id': id
                    },
                    success: function(res) {

                        swal(
                            res.action, //get from controller (block/unblock/cancel)
                            res.msg, // get from controller
                            res.status // get from controller (success/error)
                        )

                        window.LaravelDataTables["category-table"].draw();
                    }
                });
            } else {
                swal("Cancelled", "No deleted :)", "error");
            }
        }).catch((error) => {
            $('.changeStatus').attr('disabled', false);
        });

    });
</script>
@endpush