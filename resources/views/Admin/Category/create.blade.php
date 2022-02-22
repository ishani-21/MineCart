@extends('Admin.layouts.master')
@section('title', 'Category')
@section('content')
@push('css')
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet" />
@endpush
<div class="content-overlay"></div>
<div class="content-wrapper">
    <div class="col-12">
        <div class="content-header">Add Category</div>
        <p class="content-sub-header mb-1">Add category and subcategory also here .</p>
    </div>
    <div class="tab-pane active" id="general" role="tabpanel" aria-labelledby="general-tab">
        <form action="{{ route('admin.Category.categorystore') }}" enctype="multipart/form-data" id="createcategory" method="Post">
            @csrf
            <div class="row">
                <div class="media">
                    <img src="{{asset('admin-assets/app-assets/img/portrait/small/default.png')}}" class="displayimage rounded mr-3" height="64" width="64" alt="" id="upload-img-data" />
                    <div class="media-body">
                        <div class="col-12 d-flex flex-sm-row flex-column justify-content-start px-0 mb-sm-2">
                            <label class="btn btn-primary mr-sm-2 mb-1" for="image">Upload Photo</label>
                            <input type="file" id="image" class="image" name="image" hidden>
                            @error('image')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                </div>
                <hr class="mt-1 mt-sm-2">
                <div div class="col-12 form-group">
                    <label for="en_name">Name (English)</label>
                    <div class="controls">
                        <input type="text" id="en_name" name="en_name" class="form-control @error('en_name') is-invalid @enderror" value="{{ old ('en_name') }}" placeholder="Enter category name">
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
                        <input type="text" id="ar_name" name="ar_name" class="form-control @error('ar_name') is-invalid @enderror" value="{{ old ('ar_name') }}" placeholder="الرجاء إدخال الفئة">
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
                            <input type="number" id="commission" name="commission" class="form-control @error('commission') is-invalid @enderror" value="{{ old ('commission') }}" placeholder="Enter commission">
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
                        <select id="parent_id" name="parent_id" class="form-control @error('parent_id') is-invalid @enderror" value="{{ old ('parent_id') }}">
                            <option value="">Select Country</option>
                            <option value="0">Main Category</option>
                            @foreach($parent_id as $category)
                            <option value="{{$category['id']}}">{{$category['en_name']}}</option>
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
    </div>
</div>
@endsection
@push('scripts')
<script src="{{ asset('admin-assets/app-assets/js/jquery.min.js') }}"></script>
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
        $("#createcategory").validate({
            ignore: "input[type='text']:hidden",
            errorClass: 'invalid-feedback animated fadeInDown',
            errorElement: 'div',
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
                    number: true,
                },
                'image': {
                    required: true,
                    accept:"jpg,png,jpeg,gif"
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
                    required: 'The commission field is  Required.',
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
                if (element.attr("name") == "image") {
                    error.insertAfter(element.parents('.media-body'));
                } else {
                    error.insertAfter(element.parents('.form-group').find('.controls'));
                }    
            }
        });
    })
</script>
@endpush