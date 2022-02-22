@extends('Seller.layouts.master')
@section('title', 'Seller-Dashboard')
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
         <div class="content-header">Brands</div>
      </div>
   </div>
   <!-- Basic Inputs start -->
   <section id="basic-input">
      <div class="row">
         <div class="col-12">
            <div class="card">
               <div class="card-header">
                  <h4 class="card-title">Brand List</h4>
               </div>
               <div class="card-content">
                  <div class="card-body">
                     <form method="post" action="{{ route('seller.select_brand') }}" id="brand_form">
                        @csrf
                        <div class="row">
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label for="en_name">Brands</label>
                                 <small class="text-muted">eg.<i>Englist Name</i></small>
                                 <div class="row">
                                    @foreach ($brand as $brand)
                                    @if($brand->status == '0')
                                    <div class="col-md-6">
                                       <div class="form-flex-img-box">
                                          <div class="form-check">
                                             <input class="form-check-input category" type="checkbox" id="{{ $brand->id }}" data-id="{{ $brand->id }}" name="select_id[]" value="{{ $brand->id }}" @if (in_array($brand->id, $selected_brand))checked @endif>
                                             <label class="flex-img-box" for="{{ $brand->id }}">
                                                @if (isset($brand->image))
                                                <img src={{ $brand->image }} width="80px" class="img-thumbnail">
                                                @else
                                                <img src="{{ asset('saller-assets\app-assets\img\portrait\small\default-placeholder.png') }}" width="80px" class="img-thumbnail">
                                                @endif
                                                <div class="form-check-label brnd" style="font-size:15px;margin:20px;">
                                                   <div class="label-data-flex">
                                                      <span> {{ $brand->en_name }}</span>
                                                   </div>
                                                </div>
                                             </label>
                                          </div>
                                       </div>
                                    </div>
                                    @endif
                                    @endforeach
                                 </div>
                                 @error('en_name')
                                 <span role="alert">
                                    <strong style="color:red;">{{ $message }}</strong>
                                 </span>
                                 @enderror
                                 <p id="duplicat_name"></p>
                              </div>
                           </div>
                           <div class="col-md-6 border-left pl-5">
                              <h5 id="dis-brand">Selected Brands</h5>
                           </div>
                        </div>
                        <button type="submit" class="btn gradient-pomegranate big-shadow asds" disabled>Submit</button>&nbsp;&nbsp;
                        <a href="{{ route('seller.main') }}" type="submit" class="btn gradient-mint shadow-z-4">Go Back!</a>
                     </form>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </section>
</div>
@endsection
<!-- Basic Inputs end -->

@push('js')
<script>
   $(document).ready(function() {
      // $('.asds').hide();

      $('input[name="select_id[]"]:checked').each(function() {
         var id = this.value;
         $.ajax({
            headers: {
               'X-CSRF-TOKEN': $('meta[name="csrf-token"]')
                  .attr('content')
            },
            type: 'POST',
            url: "{{ route('seller.get-brand') }}",
            data: {
               'id': id
            },
            success: function(data) {
               $("#dis-brand").append("<p id=" + data.data.id +
                  " class='alert alert-secondary abc' role='alert'>" + data.data
                  .en_name + "</p>");
            }
         });
      });
   })
   $('#brand_form').validate({
      rules: {
         en_name: {
            required: true,
         },
      },
      errorElement: 'span',
      messages: {
         en_name: 'Please Enter Store Name!',
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

   $(document).ready(function() {
      var arr = [];
      $('.category').each(function() {

         if ($(this).is(':checked')) {
            arr.push($(this).val())
         }
      })
      if (arr.length >= 1) {
         $('.asds').attr('disabled', false);
      }
   })
   $(document).on("submit", '#brand_form', function() {
      var arr = [];
      $('.category').each(function() {

         if ($(this).is(':checked')) {
            arr.push($(this).val())
         }
      })
      if (arr.length == 0) {
         toastr.error("Please Select Atleast One Brand...");
         return false;
      }
   });

   $(document).on("click", '.category', function() {
      var id = $(this).data('id');
      if ($(this).is(':checked', true)) {
         $('.asds').attr('disabled', false);

         $.ajax({
            headers: {
               'X-CSRF-TOKEN': $('meta[name="csrf-token"]')
                  .attr('content')
            },
            type: 'POST',
            url: "{{ route('seller.get-brand') }}",
            data: {
               'id': id
            },
            success: function(data) {
               $("#dis-brand").append("<p id=" + data.data.id +
                  " class='alert alert-secondary category' role='alert'>" + data.data
                  .en_name + "</p>");
            }
         });
      } else {
         $('#dis-brand').find('#' + id).remove();
      }
   });

   //select store
   $(document).ready(function() {
      $('.store').on('change', function() {
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
</script>
@endpush
