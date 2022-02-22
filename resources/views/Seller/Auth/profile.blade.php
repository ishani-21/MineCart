@extends('Seller.layouts.master')
@section('title', 'Show Profile')
@push('css')
<style>
</style>
@endpush
@section('content')
<div class="content-overlay"></div>
<div class="content-wrapper">
   <section class="users-edit">
      <div class="row">
         <div class="col-12">
            <div class="card">
               <div class="card-header">
                  <h4 class="card-title">Show Profile</h4>
               </div>
               <div class="card-content">
                  <div class="card-body">
                     <form method="post" action="{{ route('seller.update_profile',$data->id)}}" id="edit_profile">
                        @csrf
                        <div class="row">
                           <div class="col-12 col-md-6">
                              <div class="form-group">
                                 <div class="controls">
                                    <label for="fname">First Name</label>
                                    <input type="text" id="fname" name="fname" class="form-control @error('fname') is-invalid @enderror" placeholder="Enter First Name" value="{{ old('name', isset($data->fname) ? $data->fname : '') }}" aria-invalid="false">
                                    @error('fname')
                                    <span class="invalid-feedback" role="alert">
                                       <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                 </div>
                              </div>
                           </div>
                           <div class="col-12 col-md-6">
                              <div class="form-group">
                                 <div class="controls">
                                    <label for="lname">Last Name</label>
                                    <input type="text" id="lname" name="lname" class="form-control @error('lname') is-invalid @enderror" placeholder="Enter Last Name" value="{{ old('en_name', isset($data->lname) ? $data->lname : '') }}" aria-invalid="false">
                                    @error('lname')
                                    <span class="invalid-feedback" role="alert">
                                       <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-12 col-md-6">
                              <div class="form-group">
                                 <div class="controls">
                                    <label for="email">Email</label>
                                    <input type="text" id="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Enter Your Email Address" value="{{ old('name', isset($data->email) ? $data->email : '') }}" aria-invalid="false">
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                       <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                 </div>
                              </div>
                           </div>
                           <div class="col-12 col-md-6">
                              <div class="form-group">
                                 <div class="controls">
                                    <label for="mobile">Mobile</label>
                                    <input type="text" id="mobile" name="mobile" class="form-control @error('mobile') is-invalid @enderror" placeholder="Enter Your Mobile Number" value="{{ old('en_name', isset($data->mobile) ? $data->mobile : '') }}" aria-invalid="false">
                                    @error('mobile')
                                    <span class="invalid-feedback" role="alert">
                                       <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-md-6 col-12">
                              <label for="country">Country</label>
                              <fieldset class="form-group">
                                 <select class="custom-select country @error('country') is-invalid @enderror" id="country" name="country" value="country">
                                    <option value="0">Select One Country</option>
                                    @foreach($country as $country)
                                    <option class="dropdown-item" value="{{ $country->id }}" {{ $country->id == $data->country_id ? 'selected' : '' }}>{{ $country->name }}</option>
                                    @endforeach
                                 </select>
                                 @error('country')
                                 <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                 </span>
                                 @enderror
                              </fieldset>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-md-6 col-12">
                              <label for="state">State</label>
                              <fieldset class="form-group">
                                 <select class="custom-select state @error('state') is-invalid @enderror" id="state" name="state" value="state">
                                    <option value="0">Select One State</option>
                                    @foreach($state as $state)
                                    <option class="dropdown-item" value="{{$state->id}}" {{$state->id == $data->state_id ? 'selected' : ''}}>{{ $state->name }}</option>
                                    @endforeach
                                 </select>
                                 @error('state')
                                 <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                 </span>
                                 @enderror
                              </fieldset>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-md-6 col-12">
                              <label for="city">City</label>
                              <fieldset class="form-group">
                                 <select class="custom-select city @error('city') is-invalid @enderror" id="city" name="city" value="city">
                                    <option value="0">Select One City</option>
                                    @foreach($city as $city)
                                    <option class="dropdown-item" value="{{$city->id}}" {{$city->id == $data->city_id ? 'selected' : ''}}>{{ $city->name }}</option>
                                    @endforeach
                                 </select>
                                 @error('city')
                                 <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                 </span>
                                 @enderror
                              </fieldset>
                           </div>
                        </div>
                        <div class="col-12 d-flex flex-sm-row flex-column justify-content-end mt-3 mt-sm-2">
                           <button type="submit" class="btn btn-primary mb-2 mb-sm-0 mr-sm-2 asd">Save Changes</button>
                           <a href="{{ route('seller.main')}}" class="btn btn-secondary">Cancel</a>
                           <!-- <button type="reset" class="btn btn-secondary">Cancel</button>   -->
                        </div>
                     </form>
                  </div>
               </div>
            </div>
         </div>
      </div>
</div>
</div>
@endsection
@push('js')

<script>
   $(document).ready(function() {
      $('.country').select2();
   });
   $(document).ready(function() {
      $('.state').select2();
   });
   $(document).ready(function() {
      $('.city').select2();
   });
   $('#edit_profile').validate({
      rules: {
         // fname: {
         //    required: true,
         // },
         // lfname: {
         //    required: true,
         // },
         // email: {
         //    required: true,
         // },
         // mobile: {
         //    required: true,
         //    maxlength: 10,
         //    minlength: 10
         // }
      },
      messages: {
         fname: "Please Enter Your First Name",
         lname: "Please Enter Your Last Name",
         email: "Please Enter Your Mobile Number",
         mobile: {
            required: 'Please Enter Your Mobile Number.',
            maxlength: 'Please enter only 10 digits.',
            minlength: 'Please enter at least 10 digits.'
         }
      },
      highlight: function(element, errorClass, validClass) {
         $(element).addClass("is-invalid").removeClass("is-valid");
      },
      unhighlight: function(element, errorClass, validClass) {
         $(element).addClass("is-valid").removeClass("is-invalid");
      },

   });

   // $('.asd').on('click', function(){
   //    swal("Good job!", "Your Profile Edit Successfully!", "success")
   // });

   $('#country').on('change', function() {
      var country = this.value;
      $.ajax({
         url: "{{ route('seller.set_state') }}",
         type: "POST",
         data: {
            country: country,
            _token: '{{ csrf_token() }}'
         },
         dataType: 'json',
         success: function(result) {
            $('#state').html('<option class="dropdown-item" value="">Select One State</option>');
            $.each(result, function(key, value) {
               $("#state").append('<option class="dropdown-item" value="' + value.id + '">' + value.name + '</option>');
            });
         }
      });
   })
   $('#state').on('change', function() {
      var state = this.value;
      $.ajax({
         url: "{{ route('seller.set_city') }}",
         type: "POST",
         data: {
            state: state,
            _token: '{{ csrf_token() }}'
         },
         dataType: 'json',
         success: function(result) {
            $('#city').html('<option class="dropdown-item" value="">Select One City</option>');
            $.each(result, function(key, value) {
               $("#city").append('<option class="dropdown-item" value="' + value.id + '">' + value.name + '</option>');
            });
         }
      });
   })
</script>
@endpush
