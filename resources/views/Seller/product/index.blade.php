@extends('Seller.layouts.master')
@section('title', 'Seller-Product')
@section('content')
<div class="content-overlay"></div>
<div class="content-wrapper">
    <div class="row">
        <div class="col-12">
            @if (Session::has('error'))
            <div class="alert alert-danger text-center asd">
                <a href="{{route('seller.login')}}" class="close" data-dismiss="alert" aria-label="close">×</a>
                <p style="color: red;">{{ Session::get('error') }}</p>
            </div>
            @endif
            <div class="content-header">Product Table</div>
        </div>
        <div class="text-right">
            <div class="mb-2">
                <a href="{{ route('seller.product.create') }}" class="btn gradient-pomegranate big-shadow">Add
                    Product</a>
            </div>
        </div>
    </div>
    <!-- Zero configuration table -->
    <section id="configuration">
        <div class="row">
            <div class="col-12 gradient-man-of-steel d-block rounded">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Product List</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <div class="table-responsive">
                                <!-- <table class="table table-striped table-bordered zero-configuration"> -->
                                {!! $dataTable->table(['class' => 'table table-bordered dt-responsive nowrap']) !!}
                                <!-- </table> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--/ Zero configuration table -->
</div>
@endsection
@push('js')


{!! $dataTable->scripts() !!}
<script>
    $(document).on('click', '.delete', function() {
        var id = $(this).data('id');
        var el = this;
        swal({
                title: "Are you sure?",
                text: "You Want To Delete The Product!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: "{{ route('seller.delete') }}",
                        type: 'POST',
                        dataType: "JSON",
                        data: {
                            'id': id,
                        },
                        cache: false,
                        success: function(data) {
                            if (data) {
                                window.LaravelDataTables["product-table"].draw();
                            } else {
                                swal("oops!", "Something went wrong", "error");
                            }
                        }
                    });
                    swal("Your Product has been deleted!", {
                        icon: "success",
                    });
                } else {
                    swal("Your Product is safe!");
                }
            });
    });


    //status
    $(document).on('click', '.status', function() {
        swal({
                title: "Are you sure?",
                text: "You Want To Change The Status!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    var id = $(this).data('id');
                    var number = $(this).attr('id', 'asd');
                    $.ajax({
                        url: "{{ route('seller.product_status') }}",
                        type: 'get',
                        data: {
                            id: id,
                        },
                        dataType: "json",
                        success: function(data) {
                            $('#product-table').DataTable().ajax.reload();
                        }
                    })
                    swal("Your Status Has Ben Change Succesfully", {
                        icon: "success",
                    });
                } else {
                    swal("Your Status is safe!");
                }
            });
    });

    // Approve
    $(document).on('click', '.approve', function() {
        toastr.error("Please Wait admin will Approve...");
    });

    //filter
    $("#product-table").on('preXhr.dt', function(e, settings, data) {
        data.type = $(".store").val();
    });
    $('.filter-name').on('change', function(e) {
        var id = $(".store").val();
        window.LaravelDataTables["product-table"].draw()
        e.preventDefault();
    });

    //select store
    $(document).ready(function() {
        $('.store').on('change', function() {
            $('.category').remove();
            var val = $(this).val();
            $('.brand').prop('checked', false);
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]')
                        .attr('content')
                },
                type: 'POST',
                url: "{{ route('seller.slecetCategory') }}",
                data: {
                    val: val,
                },
                success: function(query) {
                    $.each(query, function(index, value) {
                        $('.brand' + value.id).prop('checked', true);
                        $("#dis-category").append(
                            "<div class='alert alert-secondary category' role='alert' id=" +
                            value.id + ">" +
                            value.en_name +
                            "<small class='text-white ml-2'>commision</small>" +
                            " " + value.commission + '%' + "</div>");
                    });
                }
            });
        });
        $(".store").trigger('change');
    });
</script>
@endpush