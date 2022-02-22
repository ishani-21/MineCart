@extends('Admin.layouts.master')
@section('title', 'Store Listing')
@push('css')
<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" /> -->
<!-- <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet"> -->
<link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
@endpush
@section('content')

<div class="content-overlay"></div>
<div class="content-wrapper">
    <div class="col-12">
        <a href="{{route('admin.store.index')}}">
            <div class="content-header">@if(isset($data)){{$data->fname}}&nbsp;{{$data->lname}} @else Store Listing @endif</div>
            <p class="content-sub-header mb-1">Store is also here.</p>
        </a>
    </div>
    <hr class="mt-1 mt-sm-2"></br>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js"></script>
<script>
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
                    url: "{{ route('admin.store.changestatus') }}",
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

                        window.LaravelDataTables["storedatatable-table"].draw();
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

    $(document).on('click', '.approve', function() {
        var id = $(this).data('id');
        var is_approve = $(this).attr('is_approve');
        var msg = "";
        // 0 - pending, 1 - approve, 2 - rejected
        if (is_approve == 0) {
            msg = "Pending";
        } 
        else if(is_approve == 1)
        {
            msg = "Approve";
        }
        else {
            msg = "Rejected";
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
                    url: "{{route('admin.store.isapprove')}}",
                    type: 'PATCH',
                    data: {
                        'is_approve': is_approve,
                        'id': id
                    },
                    success: function(res) {

                        swal(
                            res.action, //get from controller (block/unblock/cancel)
                            res.msg, // get from controller
                            res.is_approve // get from controller (success/error)
                        )

                        window.LaravelDataTables["storedatatable-table"].draw();
                    }
                });
            } else {
                swal("Cancelled", "is_approve not changed :)", "error");
            }
        }).catch((error) => {
            $('.approve').attr('disabled', false);
        });
    });


    $(document).on('click', '.delete', function() {
        var id = $(this).data('id');
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
                    url: '{{ route ("admin.store.delete") }}',
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
                                'Store has been deleted.',
                                'success'
                            )
                            window.LaravelDataTables["storedatatable-table"].draw();
                        }
                    }
                });
            } else {
                swal("Cancelled", "Your record is safe :)", "error");
            }
        })
    });
    


</script>
@endpush