@component('mail::message')
# Mine Cart

Register Verify otp..........

<!-- @component('mail::button', ['url' => ''])
Button Text
@endcomponent -->
<b>Your OTP to login to access is {{$otp}}.</b>

Thanks 😊,<br>
{{ config('app.name') }}
@endcomponent
