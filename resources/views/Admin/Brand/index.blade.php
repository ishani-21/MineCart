@extends('Admin.layouts.master')
@section('title', 'Brand')
@push('css')
<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" /> -->
<!-- <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet"> -->
<link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
<style>
    body.layout-dark .pagination .page-item.active .page-link {
    background-color: #007bff!important;
    border-color: #007bff!important;
}
</style>
@endpush
@section('content')
<div class="content-overlay"></div>
<div class="content-wrapper">
    <div class="col-12">
        <div class="content-header">Brand Listing</div>
        <p class="content-sub-header mb-1">Brand List also here.</p>
    </div>
    <hr class="mt-1 mt-sm-2"></br>
    @can('brand_create')
    <a href="{{route('admin.Brand.brandview')}}"><button id="addRow" class="btn btn-primary mr-1 mb-1"><i class="ft-plus mr-2"></i>Add Brand</button></a>
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
{!! $dataTable->scripts() !!}
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.0.3/css/buttons.dataTables.min.css">

<script>
    $(document).on('click', '#cat_delete', function() {
        var id = $(this).attr('category_id');
        swal({
            // title: 'Are you sure?',
            text: "Are you sure want to Delete!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!',
            reverseButtons: true
        }).then((result) => {
            if (result) {
                $.ajax({
                    type: 'POST',
                    url: '{{ route ("admin.Brand.delete") }}',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        'id': id
                    },
                    success: function(data) {
                        if (data) {
                            swal(
                                'Deleted!',
                                'Brand has been deleted.',
                                'success'
                            )
                            window.LaravelDataTables["brand-table"].draw();
                        }
                    }
                });
            } else {
                swal("Cancelled", "Your record is safe :)", "error");
            }
        })
    });

    $(document).on('click', '.changeStatus', function() {
        var this_var = this;
        $(this).attr('disabled', true);
        var category_id = $(this).attr('category_id');
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
                    url: "{{ route('admin.Brand.changestatus') }}",
                    type: 'PATCH',
                    data: {
                        'status': status,
                        'id': category_id
                    },
                    success: function(res) {

                        swal(
                            res.action, //get from controller (block/unblock/cancel)
                            res.msg, // get from controller
                            res.status // get from controller (success/error)
                        )

                        window.LaravelDataTables["brand-table"].draw();
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
</script>
@endpush