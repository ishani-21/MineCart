@extends('Seller.layouts.master')
@section('title', 'Seller-Store')
@push('css')
    <style>
        .arebic {
            font-family: adobe Arabic;
        }

        .asd {
            margin-left: 913px;
        }

        .imagePreview {
            width: 100%;
            height: 180px;
            background-position: center center;
            background: url(http://cliquecities.com/assets/no-image-e3699ae23f866f6cbdf8ba2443ee5c4e.jpg);
            background-color: #fff;
            background-size: cover;
            background-repeat: no-repeat;
            display: inline-block;
            box-shadow: 0px -3px 6px 2px rgba(0, 0, 0, 0.2);
        }

        .btnn-primary {
            background-color: #7d4166;
            color: #fff;
            display: block;
            border-radius: 0px;
            box-shadow: 0px 4px 6px 2px rgba(0, 0, 0, 0.2);
            margin-top: -5px;
        }

        .btnn-primary:hover {
            color: #fff;
        }

        .imgUp {
            margin-bottom: 15px;
            position: relative;
        }

        .del {
            position: absolute;
            top: 0px;
            right: 11px;
            width: 30px;
            height: 30px;
            text-align: center;
            line-height: 30px;
            background-color: rgba(68, 55, 55, 0.233);
            cursor: pointer;
        }

        .imgAdd {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            background-color: #34a310;
            color: #fff;
            box-shadow: 0px 0px 2px 1px rgba(0, 0, 0, 0.2);
            text-align: center;
            line-height: 30px;
            margin-top: 0px;
            cursor: pointer;
            font-size: 15px;
            padding: 0;
        }

        .imgRemove {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            background-color: #e53e40;
            color: #fff;
            box-shadow: 0px 0px 2px 1px rgb(0 0 0 / 20%);
            text-align: center;
            line-height: 30px;
            margin-top: 0px;
            cursor: pointer;
            font-size: 15px;
            padding: 0;
            position: absolute;
            top: 5px;
            right: 16px;
        }

        .abc {
            position: relative;
        }

        .image {
            opacity: 1;
            display: block;
            width: 100%;
            height: auto;
            transition: .5s ease;
            backface-visibility: hidden;
        }

        .middle {
            transition: .5s ease;
            opacity: 0;
            position: absolute;
            top: 50%;
            left: 16%;
            transform: translate(-50%, -50%);
            -ms-transform: translate(-50%, -50%);
            text-align: center;
        }

        .abc:hover .image {
            opacity: 0.3;
        }

        .abc:hover .middle {
            opacity: 1;
        }

        .text {
            background-color: red;
            color: white;
            font-size: 25px;
            padding: 8px 15px;
        }

        .optionGroup {
            font-weight: bold;
            font-style: italic;
        }

        .optionChild {
            margin-left: 15px;
        }

    </style>
@endpush
@section('content')
    {{-- @dd($product) --}}
    {{-- @php
    $category=explode(',',$product['category'][0]['category_id']);
@endphp --}}
    {{-- @dd() --}}

    <div class="content-overlay"></div>
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12">
                <div class="content-header">Inputs</div>
            </div>
        </div>
        <!-- Basic Inputs start -->
        <section id="basic-hidden-label-form-layouts">
            <div class="row match-height">
                <!-- Basic Form starts -->
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Product Form</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <form id="submit_form" action="{{ route('seller.product.store') }}" method="post"
                                    enctype="multipart/form-data">
                                    @csrf

                                    <div class="form-row">
                                        <div class="col-md-6 col-12">
                                            <div class="form-group mb-2">
                                                <label for="basic-form-6">Category</label>
                                                <select id="category_id" name="categories_id" class="form-control">
                                                    <option value="" selected disabled>Select Category</option>
                                                    @foreach ($product['category'] as $categorys)
                                                        <option value="{{ $categorys->id }}" class="optionGroup">
                                                            {{ $categorys->en_name }}</option>
                                                        @foreach ($product['subcategory'] as $subcategorys)
                                                            @if ($categorys->id == $subcategorys->parent_id)
                                                                <option value={{ $subcategorys->id }}
                                                                    class="optionChild">
                                                                    {{ $subcategorys->en_name }}</option>
                                                            @endif
                                                        @endforeach
                                                    @endforeach
                                                </select>

                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group mb-2">
                                                <label for="basic-form-7">Brand</label>
                                                <select id="brand_id" name="brand_id" class="form-control">
                                                    <option value="" selected disabled>Select Brand</option>
                                                    @foreach ($product['brand'] as $brand)
                                                        <option value="{{ $brand->id }}">{{ $brand->en_name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="col-md-6 col-12">
                                            <div class="form-group mb-2">
                                                <label for="basic-form-1">Product Name</label>
                                                <small class="text-muted">eg.<i>Englist Name</i></small>
                                                <input type="text" id="basic-form-1" class="form-control"
                                                    data-validation-required-message="This First Name field is required"
                                                    name="en_name">
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group mb-2">
                                                <label for="basic-form-2">Product Name</label>
                                                <small class="text-muted">eg.<i>Arebic Name</i></small>
                                                <input type="text" id="basic-form-2" class="form-control" name="ar_name">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-md-6 col-12">
                                            <div class="form-group mb-2">
                                                <label for="basic-form-3">Cost Price</label>
                                                <input type="text" id="cost_price" class="form-control" name="cost_price">
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group mb-2">
                                                <label for="basic-form-3">Regular Price</label>
                                                <input type="text" id="regular_price" class="form-control"
                                                    name="regular_price">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-md-6 col-12">
                                            <div class="form-group mb-2">
                                                <label for="basic-form-3">Sale Price</label>
                                                <input type="text" id="sale_price" class="form-control" name="sale_price">
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group mb-2">
                                                <label for="basic-form-3">Total Quantity</label>
                                                <input type="text" id="basic-form-3" class="form-control"
                                                    name="total_qty">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-md-6 col-12">
                                            <div class="form-group mb-2">
                                                <label for="basic-form-9">Description</label>
                                                <small class="text-muted">eg.<i>English Name</i></small>
                                                <textarea id="en_description" rows="4" class="form-control"
                                                    name="en_description"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group mb-2">
                                                <label for="basic-form-9">Description</label>
                                                <small class="text-muted">eg.<i>Arebic Name</i></small>
                                                <textarea id="ar_description" rows="4" class="form-control"
                                                    name="ar_description"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-md-6 col-12">
                                            <div class="form-group mb-2">
                                                <label class="form-control-label" style="font-size:15px">Cover Image</label>
                                                <input class="form-control" type="file" id="cover_image"
                                                    name="cover_image">
                                                @error('cover_image')
                                                    <span class="text-danger" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group mb-2">
                                                <label for="basic-form-3">Available Quantity</label>
                                                <input type="text" id="available_stock" class="form-control"
                                                    name="available_stock">
                                            </div>
                                        </div>
                                        <div class="col-md-12 col-12">
                                            <div class="form-group">
                                                <div class="row">
                                                    <label class="col-sm-12 col-form-label" style="font-size:15px">Product
                                                        Images</label><br>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-2 imgUp">
                                                        <div class="imagePreview"></div>
                                                        <label class="btn btnn-primary">
                                                            Upload
                                                            <input type="file" name="images[]" id="fileupload"
                                                                class="uploadFile img" value="{{ old('images[]') }}"
                                                                style="width: 0px;height: 0px;overflow: hidden;">
                                                            @error('images')
                                                                <span class="text-danger" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </label>
                                                        <span id="post_error" style="color: red;"></span>
                                                    </div>
                                                    <i class="fa fa-plus imgAdd"></i>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary mr-2"><i
                                            class="ft-check-square mr-1"></i>Save</button>
                                    <a type="button" href="{{ route('seller.product.index') }}"
                                        class="btn btn-secondary"><i class="ft-x mr-1"></i>Cancel</a>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Hidden Label ends -->
            </div>
        </section>
        <!-- Basic Inputs end -->
    @endsection
    @push('js')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
        <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
        <script>
            $(document).ready(function() {
                jQuery.validator.addMethod("lettersonly", function(value, element) {
                    return this.optional(element) || /^[a-z]+$/i.test(value);
                }, "Letters only please");
                $('#submit_form').validate({
                    // rules: {
                    //     brand_id: {
                    //         required: true,
                    //     },
                    //     categories_id: {
                    //         required: true,
                    //     },
                    //     cover_image: {
                    //         required: true,
                    //     },
                    //     en_name: {
                    //         required: true,
                    //         lettersonly: true
                    //     },
                    //     ar_name: {
                    //         required: true,
                    //     },
                    //     cost_price: {
                    //         required: true,
                    //         digits: true
                    //     },
                    //     'images[]': {
                    //         required: true,
                    //     },
                    //     regular_price: {
                    //         required: true,
                    //         digits: true
                    //     },
                    //     sale_price: {
                    //         required: true,
                    //         digits: true
                    //     },
                    //     total_qty: {
                    //         required: true,
                    //         digits: true
                    //     },
                    //     available_stock: {
                    //         required: true,
                    //         digits: true
                    //     },
                    //     en_description: {
                    //         required: true,
                    //     },
                    //     ar_description: {
                    //         required: true,
                    //     },
                    //     ar_description: {
                    //         required: true,
                    //     },
                    // },
                    messages: {
                        'brand_id': {
                            'required': 'Please Select Brand'
                        },
                        'categories_id': {
                            'required': 'Please Select Category'
                        },
                        'cover_image': {
                            'required': 'Please Select image'
                        },
                        'images[]': {
                            'required': 'Please Select image'
                        },
                        'en_name': {
                            'required': 'Please Enter Name'
                        },
                        'ar_name': {
                            'required': 'Please Enter Name'
                        },
                        'cost_price': {
                            'required': 'Please Enter cost Price'
                        },
                        'regular_price': {
                            'required': 'Please Enter Regular Price'
                        },
                        'sale_price': {
                            'required': 'Please Enter sale Price'
                        },
                        'en_description': {
                            'required': 'Please Enter description'
                        },
                        'ar_description': {
                            'required': 'Please Enter description'
                        },
                        'total_qty': {
                            'required': 'Please Enter total quantity'
                        },
                        'available_stock': {
                            'required': 'Please Enter available stock'
                        },
                    },
                    highlight: function(element, errorClass, validClass) {
                        $(element).addClass("is-invalid").removeClass("is-valid");
                    },
                    unhighlight: function(element, errorClass, validClass) {
                        $(element).addClass("is-valid").removeClass("is-invalid");
                    },
                    errorPlacement: function(error, element) {
                        error.appendTo(element.parents('.form-group'));
                    },
                    submitHandler: function(form) {
                        register(form);
                    }

                });
            });


            function register(form) {
                $('.text-strong').html('');
                var store_id = $('#store').val();
                var form = $('#submit_form');
                var formData = new FormData(form[0]);
                formData.append('store_id', store_id);
                swal({
                    title: "Are you sure?",
                    text: "you want to Insert Product",
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, Save!',
                    cancelButtonText: "No, cancel plx!",
                    reverseButtons: true
                }).then((result) => {
                    if (result) {
                        $.ajax({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]')
                                    .attr('content')
                            },
                            type: 'POST',
                            url: "{{ route('seller.product.store') }}",
                            data: formData,
                            dataType: 'JSON',
                            contentType: false,
                            processData: false,
                            cache: false,
                            success: function(query) {
                                if (query) {
                                    swal("Inserted!",
                                        "Product Inserted Successfully.",
                                        "success");
                                    window.location.href =
                                        "{{ route('seller.product.index') }}";
                                }
                            },
                            error: function(data) {
                                console.log(data);
                                $.each(data.responseJSON.errors, function(
                                    key, value) {
                                    console.log(key);
                                    $('[name=' + key + ']').after(
                                        '<span class="text-strong" style="color:red">' +
                                        value + '</span>')
                                });
                            }
                        });
                    } else {
                        swal("Cancelled", "Your Product is safe :)", "error");
                    }
                });
            }
            // //multiple imgaes validation
            // $('#fileupload').change(function() {
            //     //get the input and the file list
            //     var input = document.getElementById('fileupload');
            //     console.log(input.files.length);
            //     if (input.files.length <= 1) {
            //         $('.validation').css('display', 'block');
            //     } else {
            //         $('.validation').css('display', 'none');
            //     }
            // });

            //MULTIPLE IMAGES
                $(document).on("change", ".uploadFile", function() {
                    var uploadFile = $(this);
                    var files = !!this.files ? this.files : [];
                    if (!files.length || !window.FileReader) return;

                    if (/^image/.test(files[0].type)) {
                        var reader = new FileReader();
                        reader.readAsDataURL(files[0]);

                        reader.onloadend = function() {
                            uploadFile.closest(".imgUp").find('.imagePreview').css("background-image",
                                "url(" + this.result + ")");
                        }
                    }
                });

            //image add
            $(".imgAdd").click(function() {
                $(this).closest(".row").find('.imgAdd').before(

                    '<div class="col-sm-2 imgUp" id="abc"><div class="imagePreview" id="image"></div><label class="btn btnn-primary">Upload<input type="file" name="images[]" id="post" class="uploadFile img" style="width: 0px;height: 0px;overflow: hidden;"></label><i class="fa fa-minus imgRemove" aria-hidden="true"></i></div>'
                );
            });

            //image remove
            $(document).on('click', '.imgRemove', function() {
                // Swal.fire({
                //     title: 'Are you sure?',
                //     text: "You won't be able to revert this!",
                //     icon: 'warning',
                //     showCancelButton: true,
                //     confirmButtonColor: '#3085d6',
                //     cancelButtonColor: '#d33',
                //     confirmButtonText: 'Yes, delete it!'
                // }).then((result) => {
                //     if (result.isConfirmed) {
                        $('#abc').remove();
                    //     Swal.fire(
                    //         'Deleted!',
                    //         'Your file has been deleted.',
                    //         'success'
                    //     )
                    // }
                // })
                // if (window.confirm('Are you sure you want to delete ?')) {

                // }
            })


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
