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


        .img-view-box {
            position: relative;
            width: 20%;
            margin-right: 15px;
        }

        .show-img-container {
            display: flex;
            flex-wrap: wrap;
        }


        .img-view-box img {
            width: 100%;
            max-width: 100%;
            border-radius: 6px;
        }

        .img-view-box .img-remove {
            width: 20px;
            height: 20px;
            border-radius: 50%;
            background-color: red;
            color: #fff;
            font-size: 10px;
            position: absolute;
            top: 5px;
            right: 5px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
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
    <div class="content-overlay"></div>
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12">
                <div class="content-header">Products</div>
            </div>
        </div>
        <!-- Basic Inputs start -->
        <section id="basic-hidden-label-form-layouts">
            <div class="row match-height">
                <!-- Basic Form starts -->
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Product Edit</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <form id="submit_form" action="{{ route('seller.product.update', $product[0]->id) }}"
                                    method="post" enctype="multipart/form-data">
                                    @csrf
                                    @method('put')
                                    <input type="hidden" name="id" value="{{ $product[0]->id }}">
                                    <div class="form-row">
                                        <div class="col-md-6 col-12">
                                            <div class="form-group mb-2">
                                                <label for="basic-form-7">Brand</label>
                                                <select id="brand_id" name="brand_id" class="form-control">
                                                    <option value="0" selected disabled>Select Brand</option>
                                                    @foreach ($product[1]['brand'] as $brand)
                                                        <option value="{{ $brand->id }}" @if ($brand->id == $product[0]->brand_id)selected @endif>
                                                            {{ $brand->en_name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group mb-2">
                                                <label for="basic-form-6">Category</label>
                                                <select id="category_id" name="categories_id" class="form-control">
                                                    <option value="" selected disabled>Select Category</option>
                                                    @foreach ($product[1]['category'] as $categorys)
                                                        <option value="{{ $categorys->id }}" @if ($categorys->id == $product[0]->categories_id)selected @endif
                                                            class="optionGroup"> {{ $categorys->en_name }}</option>
                                                        @foreach ($product[1]['subCategory'] as $subcategorys)
                                                            @if ($categorys->id == $subcategorys->parent_id)
                                                                <option value={{ $subcategorys->id }} @if ($subcategorys->id == $product[0]->categories_id)selected @endif
                                                                    class="optionChild">
                                                                    {{ $subcategorys->en_name }}</option>
                                                            @endif
                                                        @endforeach
                                                    @endforeach
                                                </select>

                                            </div>
                                        </div>
                                        {{-- <div class="col-md-6 col-12">
                                            <div class="form-group mb-2">
                                                <label for="basic-form-6">Category</label>
                                                <select id="categories_id" name="categories_id" class="form-control">
                                                    <option value="none" selected disabled>Select Category</option>
                                                    @foreach ($product[1]['category'] as $category)
                                                        <option value="{{ $category->id }}" @if ($category->id == $product[0]->categories_id)selected @endif>
                                                            {{ $category->en_name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div> --}}
                                    </div>
                                    <div class="form-row">
                                        <div class="col-md-6 col-12">
                                            <div class="form-group mb-2">
                                                <label for="basic-form-1">Product Name</label>
                                                <small class="text-muted">eg.<i>Englist Name</i></small>
                                                <input type="text" id="en_name" class="form-control"
                                                    data-validation-required-message="This First Name field is required"
                                                    name="en_name" value="{{ $product[0]->en_productname }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group mb-2">
                                                <label for="basic-form-2">Product Name</label>
                                                <small class="text-muted">eg.<i>Arebic Name</i></small>
                                                <input type="text" id="ar_name" class="form-control" name="ar_name"
                                                    value="{{ $product[0]->ar_productname }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-md-6 col-12">
                                            <div class="form-group mb-2">
                                                <label for="cost_price">Cost Price</label>
                                                <input type="text" id="basic-form-3" class="form-control"
                                                    name="cost_price" value="{{ $product[0]->cost_price }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group mb-2">
                                                <label for="regular_price">Regular Price</label>
                                                <input type="text" id="regular_price" class="form-control"
                                                    name="regular_price" value="{{ $product[0]->regular_price }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-md-6 col-12">
                                            <div class="form-group mb-2">
                                                <label for="sale_price">Sale Price</label>
                                                <input type="text" id="sale_price" class="form-control" name="sale_price"
                                                    value="{{ $product[0]->sale_price }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group mb-2">
                                                <label for="total_qty">Total Quantity</label>
                                                <input type="text" id="total_qty" class="form-control" name="total_qty"
                                                    value="{{ $product[0]->total_qty }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-md-6 col-12">
                                            <div class="form-group mb-2">
                                                <label for="basic-form-9">Description</label>
                                                <small class="text-muted">eg.<i>English Name</i></small>
                                                <textarea id="en_description" rows="4" class="form-control"
                                                    name="en_description">{{ $product[0]->en_discription }}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group mb-2">
                                                <label for="basic-form-9">Description</label>
                                                <small class="text-muted">eg.<i>Arebic Name</i></small>
                                                <textarea id="ar_description" rows="4" class="form-control"
                                                    name="ar_description">{{ $product[0]->ar_discription }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-md-6 col-12">
                                            <div class="form-group mb-2">
                                                <label class="form-control-label" style="font-size:15px">Cover Image</label>
                                                <input class="form-control" type="file" id="cover_image"
                                                    name="cover_image" value="{{ $product[0]->cover_image }}">
                                                <div class="img-view-box">
                                                    <img src={{ $product[0]->cover_image }}
                                                        class="rounded user-profile-stories-image"
                                                        onerror="this.style.display='none'" alt="story-image-1">
                                                </div>
                                                 @error('cover_image')
                                                    <span class="text-danger" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                                {{-- <img id="blah" src={{ $product[0]->cover_image }}
                                                    style="height: 229px; width: 100px;" alt="your image" /> --}}
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group mb-2">
                                                <label for="basic-form-3">Available Quantity</label>
                                                <input type="text" id="available_stock" class="form-control"
                                                    name="available_stock" value="{{ $product[0]->available_stock }}">
                                            </div>
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
                                                        <input type="file" name="images[]" id="post" class="uploadFile img"
                                                            value="{{ old('images[]') }}"
                                                            style="width: 0px;height: 0px;overflow: hidden;">
                                                    </label>
                                                    @php
                                                        $images = [];
                                                    @endphp
                                                    <span id="post_error" style="color: red;"></span>
                                                </div>
                                                <i class="fa fa-plus imgAdd"></i>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="show-img-container">
                                                        @foreach ($product[1]['images'] as $value)
                                                            <div class="img-view-box" id="{{ $value['id'] }}">
                                                                <img src="{{ $value['image'] }}"
                                                                    class="rounded user-profile-stories-image"
                                                                    onerror="this.style.display='none'" alt="story-image-1">
                                                                <div class="img-remove remove"
                                                                    data-id="{{ $value['id'] }}">
                                                                    <a class="fa fa-times" type="button"></a>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>
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
            </div>
        </section>
    @endsection
    @push('js')
        <script>
            $(document).ready(function() {
                jQuery.validator.addMethod("lettersonly", function(value, element) {
                    return this.optional(element) || /^[a-z]+$/i.test(value);
                }, "Letters only please");
                $('#submit_form').validate({
                    // rules: {
                    //     stor_id: {
                    //         required: true,
                    //     },
                    //     brand_id: {
                    //         required: true,
                    //     },
                    //     categories_id: {
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
                    //     },
                    //     regular_price: {
                    //         required: true,
                    //     },
                    //     sale_price: {
                    //         required: true,
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
                    // },
                    messages: {
                        'stor_id': {
                            'required': 'Please Select Store'
                        },
                        'brand_id': {
                            'required': 'Please Select Brand'
                        },
                        'categories_id': {
                            'required': 'Please Select Category'
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
                            'required': 'Please Enter quantity'
                        },
                        'available_stock': {
                            'required': 'Please Enter quantity'
                        },
                    },
                    highlight: function(element, errorClass, validClass) {
                        $(element).addClass("is-invalid").removeClass("is-valid");
                    },
                    unhighlight: function(element, errorClass, validClass) {
                        $(element).addClass("is-valid").removeClass("is-invalid");
                    },
                    submitHandler: function(form) {
                        register(form);
                    }

                });
            });

            function register(form) {
                $('.text-strong').html('');
                var form = $('#submit_form');
                var formData = new FormData(form[0]);
                swal({
                    title: "Are you sure?",
                    text: "you want to Update Product!",
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
                            url: "{{ route('seller.product.update', $product[0]->id) }}",
                            data: formData,
                            dataType: 'JSON',
                            contentType: false,
                            processData: false,
                            cache: false,
                            success: function(query) {
                                if (query) {
                                    swal("Updated!",
                                        "Product Updated Successfully.",
                                        "success");
                                    window.location.href =
                                        "{{ route('seller.product.index') }}";
                                }
                            },
                            error: function(data) {
                                $.each(data.responseJSON.errors, function(
                                    key, value) {
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

            $(document).on('click', '.remove', function() {
                // alert(1);
                var id = $(this).attr("data-id");


                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]')
                            .attr('content')
                    },
                    type: 'POST',
                    url: "{{ route('seller.delete_image') }}",
                    data: {
                        id: id,
                    },
                    success: function(query) {
                        $('.show-img-container').find('#' + id).remove();

                    }
                })
            })
        </script>
    @endpush
