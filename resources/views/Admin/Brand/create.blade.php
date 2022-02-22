@extends('Admin.layouts.master')
@section('title', 'Brand')
@push('css')
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet" />
@endpush
@section('content')
<div class="content-overlay"></div>
<div class="col-12">
    <div class="content-header">Add Brand</div>
    <p class="content-sub-header mb-1">Add Brand also here .</p>
</div>
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="tab-pane active" id="general" role="tabpanel" aria-labelledby="general-tab">
                        <form action="{{route('admin.Brand.brandstore')}}" enctype="multipart/form-data" id="createbrand" method="Post">
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
                                    <label for="en_name">Brand Name (English)</label>
                                    <div class="controls">
                                        <input type="text" id="en_name" name="en_name" class="form-control @error('en_name') is-invalid @enderror" value="{{ old('en_name') }}" placeholder="Please enter brand name">
                                        @error('en_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12 form-group">
                                    <label for="ar_name">Brand Name (Arabic)</label>
                                    <div class="controls">
                                        <input type="text" id="ar_name" name="ar_name" class="form-control @error('ar_name') is-invalid @enderror" value="{{ old('ar_name') }}" placeholder=" أدخل اسم العلامة التجارية">
                                        @error('ar_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12 d-flex flex-sm-row flex-column justify-content-end">
                                    <button type="submit" class="btn btn-primary mr-sm-2 mb-1">Submit</button>
                                    <!-- <button type="reset" class="btn btn-secondary mb-1">Cancel</button> -->
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
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
                    $('#upload-img-data').attr('src', e.target.result);
                    var formData = new FormData();
                    formData.append('photo', file);
                    return true;
                }
            };
            reader.readAsDataURL(file);
        });
        $("#createbrand").validate({
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
                'image': {
                    required: true
                }

            },
            messages: {
                'en_name': {
                    required: 'The name brand field is Required.'
                },
                'ar_name': {
                    required: 'The arrabic brand name field is  Required.'
                },
                'image': {
                    required: 'The image field is  Required.'
                },
            },
            highlight: function highlight(element, errorClass, validClass) {
                // console.log(element);
                $(element).parents("div.form-control").addClass(errorClass).removeClass(validClass);
            },
            unhighlight: function unhighlight(element, errorClass, validClass) {
                $(element).parents(".error").removeClass(errorClass).addClass(validClass);
            }
        });
    })
</script>
@endpush