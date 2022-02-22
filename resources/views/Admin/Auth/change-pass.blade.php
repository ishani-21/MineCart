@extends('Admin.layouts.master')

@section('title', 'Dashboard')

@section('content')
<title>Admin | Change Password</title>
<div class="content-overlay"></div>
<div class="content-wrapper">
    <div class="col-12">
        <div class="content-header">Change Password</div>
    </div></br>
    <hr class="mt-1 mt-sm-2"></br>
    <div class="tab-pane" id="change-password" role="tabpanel" aria-labelledby="change-password-tab">
        <form class="" action="{{ route('admin.update-password') }}" id="changepasswordform" method="post">
            @csrf
            @method('PATCH')
            <div class="form-group">
                <label for="old_password">Old Password</label>
                <div class="controls">
                    <input type="password" id="old_password" name="old_password" class="form-control" value="{{ old('old_password') }}" placeholder="Old Password" required>
                    @error('old_password')
                    <div class="alert alert-danger">
                        {{ $message }}
                    </div>
                    @enderror
                    @if($mess=Session::get('danger'))
                    <div class="alert alert-danger">
                        {{$mess}}
                    </div>
                    @endif
                </div>
            </div>
            <div class="form-group">
                <label for="new_password">New Password</label>
                <div class="controls">
                    <input type="password" id="new_password" name="new_password" class="form-control" value="{{ old ('new_password') }}" placeholder="New Password" required>
                    @error('new_password')
                    <div class="alert alert-danger">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>
            <div class="form-group">
                <label for="new_pass_confirmation">Confirm Password</label>
                <div class="controls">
                    <input type="password" id="new_pass_confirmation" name="new_pass_confirmation" value="{{ old('new_pass_confirmation') }}" class="form-control" placeholder="New Password" required>
                    @error('new_pass_confirmation')
                    <div class="alert alert-danger">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>
            <div class="d-flex flex-sm-row flex-column justify-content-end">
                <button type="submit" class="btn btn-primary mr-sm-2 mb-1">Submit</button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')

<script src="{{ asset('admin-assets/app-assets/js/jquery.min.js') }}"></script>
<script src="{{ asset('admin-assets/app-assets/js/jquery.validate.min.js') }}"></script>
<script>
    $(document).ready(function() {

        $("#changepasswordform").validate({
            errorClass: 'invalid-feedback animated fadeInDown',
            errorElement: 'div',
            rules: {
                'old_password': {
                    required: true
                },
                'new_password': {
                    required: true
                },
                'new_pass_confirmation': {
                    required: true,
                    equalTo: '#new_password'
                }

            },
            messages: {
                'old_password': {
                    required: 'The old password field is Required.'
                },
                'new_password': {
                    required: 'The new password field is  Required.'
                },
                'new_pass_confirmation': {
                    required: 'The confirm password field is  Required.',
                    equalTo: 'confirm password does not match with new password'
                }
            },
            highlight: function highlight(element, errorClass, validClass) {
                $(element).parents("div.form-control").addClass(errorClass).removeClass(validClass);
            },
            unhighlight: function unhighlight(element, errorClass, validClass) {
                $(element).parents(".error").removeClass(errorClass).addClass(validClass);
            }
        });
    });
</script>

@endpush