@extends('Seller.layouts.master')
@section('title', 'Seller-Category')
@push('css')
    <style>
        .arebic {
            font-family: adobe Arabic;
        }

        .asd {
            margin-left: 913px;
        }

    </style>
@endpush
@section('content')
    <div class="content-overlay"></div>
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12">
                <div class="content-header">Category</div>
            </div>
        </div>
        <!-- Basic Inputs start -->
        <section id="basic-input">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Category List</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <form method="post" action="{{ route('seller.store-category') }}" id="category">
                                    @csrf
                                    @if (Session::get('fail'))
                                        <div class="alert alert-danger">
                                            {{ Session::get('fail') }}
                                        </div>
                                    @endif
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="en_name">Category</label>
                                                <small class="text-muted">eg.<i>Englist Name</i></small>
                                                <div class="row">
                                                    @foreach ($category as $category)
                                                        @if ($category->status == '0')
                                                            <div class="col-md-6">
                                                                <div class="form-flex-img-box">
                                                                    <div class="form-check">

                                                                        <input
                                                                            class="form-check-input brand brand{{ $category->id }}"
                                                                            id={{ $category->id }} type="checkbox"
                                                                            data-id={{ $category->commission }}
                                                                            value="{{ $category->id }}" name="category">
                                                                        <label class="flex-img-box"
                                                                            for={{ $category->id }}>
                                                                            @if (isset($category->image))
                                                                                <img src="{{ $category->image }}"
                                                                                    width="80px" class="img-thumbnail">
                                                                            @else
                                                                                <img src="{{ asset('saller-assets\app-assets\img\portrait\small\default-placeholder.png') }}"
                                                                                    width="80px" class="img-thumbnail">
                                                                            @endif
                                                                            <div class="form-check-label brnd m-0"
                                                                                style="font-size:15px;margin:20px;">
                                                                                <div class="label-data-flex">
                                                                                    <span>{{ $category->en_name }}</span>
                                                                                    <small
                                                                                        class="text-muted">comission&nbsp;<i>{{ $category->commission }}%</i></small>
                                                                                </div>
                                                                            </div>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endif
                                                    @endforeach
                                                </div>
                                                @error('en_name')
                                                    <span role="alert">
                                                        <strong style="color:red;">{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                                <p id="duplicat_name"></p>
                                            </div>
                                        </div>
                                        <div class="col-md-6 border-left pl-5">
                                            <h5 id="dis-category">Selected Category</h5>
                                        </div>
                                    </div>
                                    <button type="submit"
                                        class="btn gradient-pomegranate big-shadow">Submit</button>&nbsp;&nbsp;
                                    <a href="{{ route('seller.main') }}" type="submit"
                                        class="btn gradient-mint shadow-z-4">Go Back!</a>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
<!-- Basic Inputs end -->

@push('js')
    <script>
        //checkbox selecte ajax
        $(document).on("change", '.brand', function() {
            var id = $(this).val();
            if ($(this).is(':checked', true)) {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]')
                            .attr('content')
                    },
                    type: 'POST',
                    url: "{{ route('seller.get-category') }}",
                    data: {
                        'id': id
                    },
                    success: function(data) {
                        $("#dis-category").append(
                            "<div class='alert alert-secondary' role='alert' id=" + data.data.id +
                            ">" +
                            data.data.en_name +
                            "<small class='text-white ml-2'>commision</small>" + " " + data
                            .data.commission + '%' + "</div>");
                    }
                });
            } else {

                $('#dis-category').find('#' + id).remove();
            }
        });


        $(document).ready(function() {
            $('#category').validate({
                rules: {
                    category: {
                        required: true,
                    }

                },
                messages: {
                    'category': {
                        'required': 'Please Select Atleast One Category'
                    },

                },
                submitHandler: function(form) {
                    register(form);
                }

            });
        });

        function register(form) {
            $('.text-strong').html('');

            swal({
                title: "Are you sure?",
                text: "you want to Insert Category",
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, Save!',
                cancelButtonText: "No, cancel plx!",
                reverseButtons: true
            }).then((result) => {
                if (result) {

                    var arr = [];
                    var commission = [];
                    $('.brand:checked').each(function() {
                        commission.push($(this).data('id'));
                        arr.push($(this).val());
                    })
                    var store_id = $('#store').val();
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]')
                                .attr('content')
                        },
                        type: 'POST',
                        url: "{{ route('seller.store-category') }}",
                        data: {
                            id: arr,
                            commission: commission,
                            storeid: store_id
                        },
                        dataType: 'JSON',
                        success: function(query) {
                            if (query) {
                                swal("Inserted!",
                                    "Category Inserted Successfully.",
                                    "success");
                            }
                        },
                        error: function(data) {
                            $.each(data.responseJSON.errors, function(
                                key, value) {
                                console.log(key);
                                $('[name=' + key + ']').after(
                                    '<span class="text-strong" style="color:red">' +
                                    value + '</span>');
                            });
                        }
                    });
                } else {
                    swal("Cancelled", "Your record is safe :)", "error");
                }
            });
        }

        //store vise category selected
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
                        console.log(query);
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
