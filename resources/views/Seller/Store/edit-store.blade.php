@extends('Seller.layouts.master')
@section('content')
<div class="content-overlay"></div>
<div class="content-wrapper">
   <section class="users-edit">
      <div class="row">
         <div class="col-12">
            <div class="card">
               <div class="card-header">
                  <h4 class="card-title">Edit Store</h4>
               </div>
               <div class="card-content">
                  <div class="card-body">
                     <form method="post" action="{{ route('seller.update_store',$showStore->id)}}" id="edit_store">
                        @csrf
                        <div class="row">
                           <div class="col-12 col-md-6">
                              <div class="form-group">
                                 <div class="controls">
                                    <label for="en_name">Store Name</label>
                                    <small class="text-muted">eg.<i>Englist Name</i></small>
                                    <input type="text" id="en_name" name="en_name" class="form-control @error('en_name') is-invalid @enderror" placeholder="Store Name" value="{{ old('en_name', isset($showStore->en_name) ? $showStore->en_name : '') }}" aria-invalid="false">
                                    @error('en_name')
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
                                    <label for="ar_name">Store Name</label>
                                    <small class="text-muted">eg.<i>Arebic Name</i></small>
                                    <input type="text" id="ar_name" name="ar_name" class="form-control @error('ar_name') is-invalid @enderror" placeholder="Store Name" value="{{ old('en_name', isset($showStore->ar_name) ? $showStore->ar_name : '') }}" aria-invalid="false">
                                    @error('ar_name')
                                    <span class="invalid-feedback" role="alert">
                                       <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="form-group">
                              <div class="controls">
                                 <label for="email">Email</label>
                                 <input type="text" id="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Store Name" value="{{ old('en_name', isset($showStore->email) ? $showStore->email : '') }}" aria-invalid="false">
                                 @error('email')
                                 <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                 </span>
                                 @enderror
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-12 col-md-6">
                              <div class="form-group">
                                 <div class="controls">
                                    <label for="en_description">Description</label>
                                    <small class="text-muted">eg.<i>Englist Name</i></small>
                                    <textarea id="en_description" rows="4" class="form-control @error('en_description') is-invalid @enderror" name="en_description">{!! $showStore->en_description !!}</textarea>
                                    @error('en_description')
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
                                    <label for="ar_description">Description</label>
                                    <small class="text-muted">eg.<i>Arebic Name</i></small>
                                    <textarea id="ar_description" rows="4" class="form-control @error('ar_description') is-invalid @enderror" name="ar_description">{!! $showStore->ar_description !!}</textarea>
                                    @error('ar_description')
                                    <span class="invalid-feedback" role="alert">
                                       <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="col-12 d-flex flex-sm-row flex-column justify-content-end mt-3 mt-sm-2">
                           <button type="submit" class="btn btn-primary mb-2 mb-sm-0 mr-sm-2">Save Changes</button>
                           <button type="reset" class="btn btn-secondary">Cancel</button>
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
      $('#edit_store').validate({
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
         messages: {
            en_name: 'Please Enter Store Name!',
            ar_name: 'Please Enter Store Name!',
            email: 'Please Enter Your Email Address!',
            en_description: 'Please Write Description!',
            ar_description: 'Please Write Description!',
         },
      });
   })
</script>
@endpush