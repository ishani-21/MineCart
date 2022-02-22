@extends('Seller.layouts.master')
@section('title', 'Seller-ChangePassword')
@section('content')
    <div class="content-overlay"></div>
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12">
                <div class="content-header">Inputs</div>
            </div>
        </div>
        <!-- Basic Inputs start -->
        <section id="basic-input">
            <div class="row">
                <div class="col-9">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Confirm Password</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                @if (session('error'))
                                    <div class="alert alert-danger">
                                        {{ session('error') }}
                                    </div>
                                @endif
                                @if (session('success'))
                                    <div class="alert alert-success">
                                        {{ session('success') }}
                                    </div>
                                @endif
                                @if ($errors)
                                    @foreach ($errors->all() as $error)
                                        <div class="alert alert-danger">{{ $error }}</div>
                                    @endforeach
                                @endif
                                <form method="post" action="{{ route('seller.changePasswordPost') }}" id="changePassword">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6">
                                            <fieldset class="form-group">
                                                <label for="basicInput">Corrent Password</label>
                                                <input type="password" class="form-control" name="current-password"
                                                value="{{ old('current-password') }}" placeholder="Enter Your Corrent Password">
                                            </fieldset>

                                            <fieldset class="form-group">
                                                <label for="helpInputTop">New Password</label>
                                                <input type="password" class="form-control" name="new-password" id="new-password"
                                                    placeholder="Enter Your New Password">
                                            </fieldset>

                                            <fieldset class="form-group">
                                                <label for="helperText">Confirm Password</label>
                                                <input type="password" name="confirm_password" id="confirm_password"
                                                    class="form-control" placeholder="Enter Your Confirm Password">
                                            </fieldset>
                                            <fieldset class="form-group">
                                                <button type="submit" class="btn gradient-pomegranate big-shadow">Change
                                                    password</button>&nbsp;&nbsp;
                                                <a href="{{ route('seller.main') }}" type="submit"
                                                    class="btn gradient-mint shadow-z-4">Go Back!</a>
                                            </fieldset>

                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $('#changePassword').validate({
            rules: {
                'current-password': {
                    required: true,
                },
                'new-password': {
                    required: true,
                },
                confirm_password: {
                    required: true,
                    equalTo: "#new-password"
                }

            },
            messages: {
                //  errorElement: 'span',
                password: {
                    required: 'Please Enter Your Password.',
                    minlength: 'Please Enter at least 8 characters.'
                },
                cpassword: {
                    required: 'Please Enter Confirmation.',
                    equalTo: 'Please Enter Confirm Password Same as a Password.'
                },
            },
            highlight: function(element, errorClass, validClass) {
                $(element).addClass('is-invalid');
                $(element).parents("div.form-control").addClass(errorClass).removeClass(validClass);
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
                $(element).parents(".error").removeClass(errorClass).addClass(validClass);
            },
            errorPlacement: function(error, element) {
                error.insertAfter(element.parent());
            },
        });
    });
</script>
