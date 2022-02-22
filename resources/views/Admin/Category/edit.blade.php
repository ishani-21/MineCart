@extends('Admin.layouts.master')
@section('title', 'Category')
@push('css')
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet" />
<style>
    .btn-twitter {
    background-color: #c11f26;
    border: 1px solid #55ACEE;
}
    .btn-edit {
    background-color: #007BB6!important;
    border: 1px solid #55ACEE;
}
</style>
@endpush
@section('content')
<div class="content-overlay"></div>
<div class="content-wrapper">
    <div class="col-12">
        <a href="{{route('admin.Category.categoryindex')}}"><div class="content-header">Edit Category</div></a>
        <p class="content-sub-header mb-1">Edit category and subcategory also here .</p>
    </div>
    <div class="tab-pane active" id="general" role="tabpanel" aria-labelledby="general-tab">
        <form action="{{ route('admin.Category.categoryupdate',$data->id) }}" enctype="multipart/form-data" id="editcategory" method="Post">
            @csrf
            <input type="hidden" id="id" name="id" value="{{$data->id}}">
            <div class="row">
                <div class="media">
                    <img src="{{$data->image}}" class="displayimage rounded mr-3" height="64" width="64" alt="" id="upload-img-data" />
                    <div class="media-body">
                        <div class="col-12 d-flex flex-sm-row flex-column justify-content-start px-0 mb-sm-2">
                            <label class="btn btn-primary mr-sm-2 mb-1" for="image">Upload Photo</label>
                            <input type="file" id="image" class="image" name="image" hidden>
                        </div>
                        <p class="text-muted mb-0 mt-1 mt-sm-0">
                            <small>Allowed JPG, GIF or PNG. Max size of 256 X 256 pixel.</small>
                        </p>
                        @error('image')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <hr class="mt-1 mt-sm-2">
                <div div class="col-12 form-group">
                    <label for="en_name">Name (English)</label>
                    <div class="controls">
                        <input type="text" id="en_name" name="en_name" class="form-control @error('en_name') is-invalid @enderror" value="{{ old('en_name', isset($data->en_name) ? $data->en_name : '') }}" placeholder="Enter category name">
                        @error('en_name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="col-12 form-group">
                    <label for="ar_name">Name (Arabic)</label>
                    <div class="controls">
                        <input type="text" id="ar_name" name="ar_name" class="form-control @error('ar_name') is-invalid @enderror" value="{{ old('ar_name', isset($data->ar_name) ? $data->ar_name : '') }}" placeholder="الرجاء إدخال الفئة">
                        @error('ar_name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="col-12 form-group">
                    <label for="commission">Category Commission</label>
                    <div class="controls">
                        <div class="input-group mb-0">
                            <input type="number" id="commission" name="commission" class="form-control @error('commission') is-invalid @enderror" value="{{ old('commission', isset($data->commission) ? $data->commission : '') }}" placeholder="Enter commission">
                            <div class="input-group-append">
                                <span class="input-group-text">%</span>
                            </div>
                        </div>
                        @error('commission')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="col-12 form-group">
                    <label for="parent_id">parent_id</label>
                    <div class="controls">
                        <select id="parent_id" name="parent_id" class="form-control @error('parent_id') is-invalid @enderror" value="{{ old('parent_id', isset($data->parent_id) ? $data->parent_id : '') }}">
                            <option value="">Select Category</option>
                            <option value="0" {{ "0" == $data->parent_id ? 'selected' : '' }}>Main Category</option>
                            @foreach($parent_id as $category)
                            <option value="{{$category['id']}}" {{ $category['id'] == $data->parent_id ? 'selected' : '' }}>{{$category['en_name']}}</option>
                            @endforeach

                        </select>
                        @error('parent_id')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="col-12 d-flex flex-sm-row flex-column justify-content-end">
                    <button type="submit" class="btn btn-primary mr-sm-2 mb-1">Save Changes</button>
                    <!-- <button type="reset" class="btn btn-secondary mb-1">Cancel</button> -->
                </div>
            </div>
        </form>
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Subcategory of {{$data->en_name}}&nbsp;(&nbsp;{{ $data->ar_name }}&nbsp;)</h4>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>English</th>
                                        <th>Arrabic</th>
                                        <th>Image</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 1;
                                    ?>
                                    @foreach($subcategory as $sub)
                                    <tr id="{{$sub->id}}">
                                        <td>{{$i}}<?php $i++; ?></td>
                                        <td>{{$sub->en_name}}</td>
                                        <td>{{$sub->ar_name}}</td>
                                        <td>
                                            <img style="height: 43px;" class="rounded" src="{{$sub->image}}"></img>
                                        </td>
                                        <td>
                                            <button data-id="{{$sub->id}}" type="button" class="btn btn-social-icon btn-edit mr-2 edit"><i class="fa ft-edit"></i></button>
                                            <button data-id="{{$sub->id}}" type="button" class="btn btn-social-icon btn-twitter mr-2 delete"><i class="fa fa-trash-o"></i></button>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- </div> -->
@endsection
@section('modal')
<!-- Modal -->
<div class="modal fade" id="subcategory_edit_modal" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-modal="true" aria-labelledby="subcategory_edit_modal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="workerLabel">Edit Subcategory</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('admin.Category.subcategoryupdate')}}" method="POST" enctype="multipart/form-data" id="subcategory_edit_form">
                    @csrf
                    <input type="hidden" id="subcate_id" name="subcate_id">
                    <div class="form-group">
                        <div class="media">
                            <div id="img">
                                <img src="" class="displayimagee rounded mr-3" height="64" width="64" alt="" id="upload" />
                            </div>
                            <div class="media-body">
                                <div class="col-12 d-flex flex-sm-row flex-column justify-content-start px-0 mb-sm-2">
                                    <label class="btn btn-primary mr-sm-2 mb-1" for="uploaded">Upload Photo</label>
                                    <input type="file" id="uploaded" class="upload" name="uploaded" hidden>
                                </div>
                                <p class="text-muted mb-0 mt-1 mt-sm-0">
                                    <small>Allowed JPG, GIF or PNG. Max size of 256 X 256 pixel.</small>
                                </p>
                                @error('image')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Enter Name (English) :</label>
                        <input type="text" id="ename" name="ename" value="" class="form-control" placeholder="Please enter name">
                        <span class="error-msg-input text-danger"></span>
                    </div>
                    <div class="form-group">
                        <label>Enter Name (Arrabic) :</label>
                        <input type="text" id="aname" name="aname" class="form-control" placeholder="Please enter name">
                        <span class="error-msg-input text-danger"></span>
                    </div>
                    <div class="form-group">
                    <label for="commission">Category Commission</label>
                        <div class="controls">
                            <div class="input-group mb-0">
                                <input type="text" id="commission" name="commission" class="commission form-control @error('commission') is-invalid @enderror" value="{{ old('commission', isset($data->commission) ? $data->commission : '') }}" placeholder="Enter commission">
                                <div class="input-group-append">
                                    <span class="input-group-text">%</span>
                                </div>
                            </div>
                            @error('commission')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Enter Name (English) :</label>
                        <select id="sparent_id" name="sparent_id" class="form-control @error('parent_id') is-invalid @enderror" value="{{ old('sparent_id', isset($data->parent_id) ? $data->parent_id : '') }}">
                            <option value="">Select Category</option>
                            <option value="0">Main Category</option>

                            @foreach($parent_id as $category)
                            <option value="{{$category['id']}}" {{ $category['id'] == $data->id ? 'selected' : '' }}>{{$category['en_name']}}</option>
                            @endforeach
                        </select>
                        <span class="error-msg-input text-danger"></span>
                    </div>
                    <div class="form-group">
                        <div>
                            <button type="submit" class="btn btn-primary waves-effect waves-light">
                                Submit
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<!-- <script src="{{ asset('admin-assets/app-assets/js/jquery.min.js') }}"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script> -->
<script src="{{ asset('admin-assets/app-assets/js/jquery.validate.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>
<script>
    $(document).ready(function() {

        $('.image').on('change', function() {
            var file = this.files[0];
            var reader = new FileReader();

            reader.onload = function(e) {
                var img = new Image();
                img.src = e.target.result;
                img.onload = function() {
                    var w = this.width;
                    var h = this.height;
                    console.log("w = " + w + "h = " + h);
                        $('#upload-img-data').attr('src', e.target.result);
                        var formData = new FormData();
                        formData.append('photo', file);
                        return true;
                }
            };
            reader.readAsDataURL(file);
        });
        $('#uploaded').on('change', function() {
            var file = this.files[0];
            var reader = new FileReader();

            reader.onload = function(e) {
                var img = new Image();
                img.src = e.target.result;
                img.onload = function() {
                    var w = this.width;
                    var h = this.height;
                    console.log("w = " + w + "h = " + h);
                    // if (w == 256 && h == 256) {
                        $('#upload').attr('src', e.target.result);
                        var formData = new FormData();
                        formData.append('photo', file);
                        return true;
                    // } else {
                        toastr.error("Allowed JPG, GIF or PNG. Max size of 256 X 256 pixel.");
                        setTimeout(function() {},
                            2000);
                    // }
                }
            };
            reader.readAsDataURL(file);
        });
        $("#editcategory").validate({
            errorClass: 'invalid-feedback animated fadeInDown',
            rules: {
                'en_name': {
                    required: true
                },
                'ar_name': {
                    required: true
                },
                'parent_id': {
                    required: true,
                },
                'commission': {
                    required: true,
                },
                'image': {
                    required: true,
                }

            },
            messages: {
                'en_name': {
                    required: 'The name category field is Required.'
                },
                'ar_name': {
                    required: 'The arrabic category name field is  Required.'
                },
                'parent_id': {
                    required: 'The main category field is  Required.',
                },
                'commission': {
                    required: 'The commission field is Required.',
                },
                'image': {
                    required: 'The image field is  Required.',
                }
            },
            highlight: function highlight(element, errorClass, validClass) {
                $(element).parents("div.form-control").addClass(errorClass).removeClass(validClass);
            },
            unhighlight: function unhighlight(element, errorClass, validClass) {
                $(element).parents(".error").removeClass(errorClass).addClass(validClass);
            },
            errorPlacement: function(error, element) {
                error.insertAfter(element.parents('.form-group').find('.controls'));
            }
        });
        $('.edit').on('click', function() {
            $("#subcategory_edit_modal").modal('show');
            var id = $(this).data('id');
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
                url: '{{route("admin.Category.subcategoryedit")}}',
                type: 'post',
                data: {
                    id: id, 
                },
                success: function(data) {
                    console.log(data.subcategory);
                    $("#subcate_id").val(data.subcategory.id);
                    $("#ename").val(data.subcategory.en_name);
                    $("#aname").val(data.subcategory.ar_name);
                    $(".commission").val(data.subcategory.commission);
                    $("#subcategory_edit_modal").find('#upload').prop('src',data.subcategory.image);
                }
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
                        url: '{{ route ("admin.Category.subdelete") }}',
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
                            }
                            // $(this).parents('tr').remove();
                            $('#'+id).fadeTo(50, 50, function () { 
                                $('#'+id).remove();
                            });
                            // $($(this).closest("tr")).remove();
                        }
                    });
                } else {
                    swal("Cancelled", "Your record is safe :)", "error");
                }
            })
        });
        $("#subcategory_edit_form").validate({
            errorClass: 'invalid-feedback animated fadeInDown',
            errorElement: 'div',
            rules: {
                'ename': {
                    required: true
                },
                'aname': {
                    required: true
                },
                'sparent_id': {
                    required: true,
                },
                'commission': {
                    required: true,
                },
                'uploaded': {
                    required: true,
                }

            },
            messages: {
                'ename': {
                    required: 'The name category field is Required.'
                },
                'aname': {
                    required: 'The arrabic category name field is  Required.'
                },
                'sparent_id': {
                    required: 'The main category field is  Required.',
                },
                'commission': {
                    required: 'The commission field is  Required.',
                },
                'uploded': {
                    required: 'The image field is  Required.',
                }
            },
            highlight: function highlight(element, errorClass, validClass) {
                $(element).parents("div.form-control").addClass(errorClass).removeClass(validClass);
            },
            unhighlight: function unhighlight(element, errorClass, validClass) {
                $(element).parents(".error").removeClass(errorClass).addClass(validClass);
            },
            errorPlacement: function(error, element) {
                error.insertAfter(element.parents('.form-group'));
            }
        });
    })
</script>
@endpush