<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css" type="text/css">
    <script src="https://kit.fontawesome.com/fec0b8725b.js" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital@1&display=swap" rel="stylesheet">
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

    <title>Forgot Password</title>
</head>
<style>
    /*reset stylesheet*/
    * {
        box-sizing: border-box;
        margin: 0;
        padding: 0;
    }

    .text-danger {
        color: red;
    }

    .error {
        color: red;
    }

    html {
        text-align: center;
        font-family: 'Roboto', sans-serif;
        color: #000000;
    }

    body {
        min-height: 100vh;
        width: 100%;
    }

    /*********containers*********/
    #god-container {
        background-color: #886227;
        display: flex;
        margin: 12%;
        padding: 0.3%;
        border-radius: 20%;
    }

    #super-container1 {
        background-color: #f2f2f2;
        flex: 1;
        padding-top: 9%;
        border-radius: 5% 0 0 5%;
    }

    #super-container2 {
        background-color: #E5E5E5;
        flex: 3;
        padding-top: 2%;
        border-radius: 0 5% 5% 0;
    }

    /*********titles & paragraphs*******/
    h1 {
        margin-bottom: 2%;
        font-size: 3em;
    }

    .title-h2 {
        padding: 5% 10%;
        font-family: 'Roboto', sans-serif;
        font-size: 3em;
    }

    .subtitle-p {
        padding: 3%;
        font-family: 'Montserrat', sans-serif;
    }

    p,
    label {
        font-family: 'Montserrat', sans-serif;
    }

    /*****buttons*****/

    .button1 {
        margin-top: 6%;
        margin-bottom: 30%;
        width: 40%;
        padding: 3%;
        border-radius: 800px;
        border: 0 solid transparent;
        background-color: #f1c47b;
    }

    .button1:hover,
    .button2:hover {
        background-color: #e79e28
    }

    .button2 {
        background-color: #f1c47b;
        margin-top: 0%;
        margin-bottom: 3%;
        width: 20%;
        padding: 1.5%;
        border-radius: 800px;
        border: 0 solid transparent;
    }

    /******form******/
    .input-div {
        display: block;
        margin: 1%;
    }

    .div-button1 a {
        text-decoration: none;
        font-size: 14px;
        font-weight: 600;
        padding: 10px 12px;
        width: 100%;
        color: #000;
        max-width: 80%;
        display: inline-block;
    }

    .input-div>input {
        padding: 15px;
        border-radius: 50px;
        background-color: rgb(235, 235, 245);
        border: 0 solid transparent;
    }

    .do-you-subrscibe {
        margin-top: 3%;
        margin-bottom: 1%;
    }

    /*****icons*****/
    .buttons-login {
        margin-bottom: 2%;
    }

    .form-group {
        margin: 0 auto;
        margin-bottom: 20px;
        max-width: 400px;
    }

    .form-group .input-div>input {
        width: 100%
    }

    .fab {
        width: 10%;
        padding: 1%;
        color: rgb(180, 171, 158);
    }

    .fab:hover {
        color: rgb(102, 96, 88);
    }

    .is-invalid {
        border: red 3px solid !important;
    }

    .form-group .error {
        font-size: 13px;
        display: block;
        text-align: left;
        margin-top: 0;
    }
</style>

<body>
    <div id="god-container">
        <div id="super-container1">
            <h2 class="title-h2">Welcome Back!</h2>
            <div class="container-p">
                <p class="subtitle-p"> To keep connected with us please login with your personal info.</p>
                <div class="div-button1">
                    <a href="{{ route('seller.register') }}" type="submit" class="btn btn-danger btn-md button1">Sign
                        Up</a>
                    <!-- <input class="button1" type="submit" href="{{ route('seller.register') }}" value="Sign Up"> -->
                </div>
            </div>
        </div>

        <br>
        <div id="super-container2">
            <div class="title-container">
                <h1>Forgotton Password</h1>
            </div>

            <div class="form">
                <form method="POST" action="{{route('seller.forgot_password')}}" id="login_form">
                    @csrf
                    <div class="container-p">
                        <h4 style="color:darkgreen;"><b>Please Enter Your Email Address. You will Receive A Link To Create a New Password Via Email.</b></h4>

                        <!-- <p class="request-data">Please Enter Your Email Address. You will Receive A Link To Create a New Password Via Email.</p> -->
                    </div><br />
                    <div class="form-group">
                        <div class="input-div">
                            <label></label>
                            <input type="text" name="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="Enter Your Email address">
                        </div>
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-danger btn-md button2">
                        {{ __('Send password Resent Link') }}
                    </button>
                </form>

            </div>
        </div>
    </div>
</body>

</html>
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
<script>
    $('#login_form').validate({
        rules: {
            email: {
                required: true,
            },
        },
        messages: {
            email: 'Please Enter Your Email Address!',
        },
        highlight: function(element, errorClass, validClass) {
            $(element).addClass("is-invalid").removeClass("is-valid");
        },
        unhighlight: function(element, errorClass, validClass) {
            $(element).addClass("is-valid").removeClass("is-invalid");
        },
        errorPlacement: function(error, element) {
            error.insertAfter(element.parent());
        },
    });
</script>