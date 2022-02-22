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
</style>
@endpush
@section('content')
<div class="content-overlay"></div>
<div class="content-wrapper">
   <div class="row">
      <div class="col-12">
         <div class="content-header">Here Add Store</div>
      </div>
   </div>
   <!-- Basic Inputs start -->
   <section id="basic-input">
      <div class="row">
         <div class="col-12">
            <div class="card">
               <div class="card-header">
                  <!-- <h4 class="card-title">Store</h4> -->
               </div>
               <div class="card-content">
                  <div class="card-body">
                     <form method="post" action="{{ route('seller.create_store')}}" id="store_form">
                        @csrf
                        <div class="row">
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label for="en_name">Store Name</label>
                                 <small class="text-muted">eg.<i>Englist Name</i></small>
                                 <input type="text" class="form-control en_name @error('en_name') is-invalid @enderror" id="en_name" name="en_name" value="{{ old('en_name') }}" placeholder="Enter Store Name">
                                 <span class="fadeIn second" id="en_name_error" style="color:red;"></span>
                                 @error('en_name')
                                 <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                 </span>
                                 @enderror
                                 <p id="duplicat_name"></p>
                              </div>
                           </div>
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label for="ar_name">Store Name</label>
                                 <small class="text-muted">eg.<i>Arebic Name</i></small>
                                 <input type="text" class="form-control arebic ar_name @error('ar_name') is-invalid @enderror" id="ar_name" name="ar_name" value="{{ old('ar_name') }}" placeholder="Enter Store Name">
                                 @error('ar_name')
                                 <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                 </span>
                                 @enderror
                                 <p id="duplicat_arname"></p>
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="form-group">
                              <label for="email">Email</label>
                              <small class="text-muted">eg.<i>Arebic Name</i></small>
                              <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" placeholder="Enter Email">
                              @error('email')
                              <span class="invalid-feedback" role="alert">
                                 <strong>{{ $message }}</strong>
                              </span>
                              @enderror
                              <p id="duplicat_arname"></p>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label for="en_description">Description</label>
                                 <small class="text-muted">eg.<i>Englist Description</i></small>
                                 <textarea id="en_description" rows="4" class="form-control @error('en_description') is-invalid @enderror" name="en_description" placeholder="Enter Store Description"></textarea>
                                 <!-- <span class="fadeIn second" id="en_description_error" style="color:red;"></span> -->
                                 @error('en_description')
                                 <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                 </span>
                                 @enderror
                                 <p id="duplicat_name"></p>
                              </div>
                           </div>
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label for="ar_description">Description</label>
                                 <small class="text-muted">eg.<i>Arebic Description</i></small>
                                 <textarea id="ar_description" rows="4" class="form-control @error('ar_description') is-invalid @enderror" value="{{ old('ar_description') }}" name="ar_description" placeholder="Enter Store Description"></textarea>
                                 <!-- <input type="text" class="form-control arebic ar_description @error('ar_description') is-invalid @enderror" id="ar_description" name="ar_description" placeholder="Enter Store Name"> -->
                                 @error('ar_description')
                                 <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                 </span>
                                 @enderror
                                 <p id="duplicat_arname"></p>
                              </div>
                           </div>
                        </div>
                        <button type="submit" class="btn gradient-pomegranate big-shadow add">Submit</button>
                        <a href="{{ route('seller.store_list')}}" type="submit" class="btn gradient-pomegranate big-shadow">Cancel</a>
                     </form>
                  </div>
               </div>
               <!-- Packages -->
               <div class="card-content">
                  <div class="card-body">
                     <div class="row">
                        @foreach($plans as $plan)
                        <div class="col-xl-4 col-md-6 col-12">
                           <div class="card">
                              <div class="card-header">
                                 <h4 class="card-title">{{$plan->en_package_name}}</h4>
                              </div>
                              <div class="card-content">
                                 <div class="card-body">
                                    Duration : {{$plan->duration}}
                                    <fieldset>
                                       <div class="input-group">
                                          <div class="row">
                                             Price : {{$plan->price}} only &nbsp;
                                             <button class="btn btn-info mr-1 mb-1 plan" data-id="{{$plan->id}}">Buy Now</button>
                                          </div>
                                       </div>
                                    </fieldset>
                                 </div>
                              </div>
                           </div>
                        </div>
                        @endforeach
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>

   </section>
   <!-- Basic Inputs end -->
   @endsection
   @push('js')
   <script>
      $('#store_form').validate({
         rules: {
            en_name: {
               required: true,
            },
            ar_name: {
               required: true,
            },
            email: {
               required: true,
            },
            en_description: {
               required: true,
            },
            ar_description: {
               required: true,
            },
         },
         errorElement: 'span',
         messages: {
            en_name: 'Please Enter Store Name!',
            ar_name: 'Please Enter Store Name!',
            email: 'Please Enter Your Email Address!',
            en_description: 'Please Write Description!',
            ar_description: 'Please Write Description!',
         },
         // highlight: function(element, errorClass, validClass) {
         //    $(element).addClass("is-invalid").removeClass("is-valid");
         // },
         // unhighlight: function(element, errorClass, validClass) {
         //    $(element).addClass("is-valid").removeClass("is-invalid");
         // },
         // errorPlacement: function(error, element) {
         //    error.insertAfter(element.parent());
         // },
         submitHandler: function(form) {
            register(form);
         }
      });

      $(document).on('click', '.plan', function() {
         var id = $(this).data('id');
         $.ajax({
            url: "{{ route('seller.paymentPage') }}",
            type: 'POST',
            data: {
               id: id,
               _token: '{{ csrf_token() }}'
            },
            dataType: "json",
            success: function(data) {
               window.location.href = "paymentpage";
            }
         })
      });

      // dublicate store name en
      // $('.en_name').blur(function() {
      //    var error_phone = '';
      //    var en_name = $('.en_name').val();
      //    var _token = $('input[name = "_token"]').val();
      //    var filter = /(^([a-zA-z]+)(\d+)?$)/u;
      //    if (!filter.test(en_name)) {
      //       $('#error').addClass('has-error');
      //       $('#duplicat_name').html('<label class = "text-danger">Please Enter vaild Store Name !!</label>');
      //       $('.add').attr('disabled', 'disabled');
      //    } else {
      //       $.ajax({
      //          url: "{{ route('seller.en_name')}}",
      //          method: "POST",
      //          data: {
      //             en_name: en_name,
      //             _token: _token
      //          },
      //          success: function(result) {
      //             if (result != 'Name_Exists') {
      //                $('#duplicat_name').html(
      //                   '<label class = "text-success">Now Store Name Available !!</label>'
      //                );
      //                $('.en_name').removeClass('has-error');
      //                $('.add').attr('disabled', false);
      //             } else if (result != 'Unique') {
      //                $('#duplicat_name').html(
      //                   '<label class = "text-danger">Store Name is already exits !!</label>'
      //                );
      //                $('#mobile').addClass('has-error');
      //                $(':input[type="submit"]').prop('disabled', true);
      //                $('.add').attr('disabled', true);
      //             }
      //          },
      //          submitHandler: function(form) {
      //             register(form);
      //          }
      //       })
      //    }
      // });

      // dublicate store name ar
      // $('.ar_name').blur(function() {
      //    var error_phone = '';
      //    var ar_name = $('.ar_name').val();
      //    var _token = $('input[name = "_token"]').val();
      //    var filter = /(^([a-zA-z]+)(\d+)?$)/u;
      //    if (!filter.test(ar_name)) {
      //       $('#error').addClass('has-error');
      //       $('#duplicat_arname').html('<label class = "text-danger">Please Enter vaild Store Name !!</label>');
      //       $('.add').attr('disabled', 'disabled');
      //    } else {
      //       $.ajax({
      //          url: "{{ route('seller.ar_name')}}",
      //          method: "POST",
      //          data: {
      //             ar_name: ar_name,
      //             _token: _token
      //          },
      //          success: function(result) {
      //             if (result != 'Name_Exists') {
      //                $('#duplicat_arname').html(
      //                   '<label class = "text-success">Now Store Name Available !!</label>'
      //                );
      //                $('.ar_name').removeClass('has-error');
      //                $('.add').attr('disabled', false);
      //             } else if (result != 'Unique') {
      //                $('#duplicat_arname').html(
      //                   '<label class = "text-danger">Store Name is already exits !!</label>'
      //                );
      //                $('#mobile').addClass('has-error');
      //                $('.add').attr('disabled', true);
      //             }
      //          }
      //       })
      //    }
      // });
   </script>
   @endpush