@extends('Seller.layouts.master')
@section('content')
<div class="content-overlay"></div>
        <div class="content-wrapper">
          <!--Under Maintenance Starts-->
          <section id="maintenance" class="auth-height">
            <div class="container-fluid">
              <div class="row full-height-vh">
                <div class="col-12 d-flex align-items-center justify-content-center">
                  <div class="row">
                    <div class="col-12 text-center">
                      <img src="{{ asset('saller-assets/app-assets/img/gallery/maintenance.png') }}" alt="" class="img-fluid maintenance-img mt-2"
                        height="300" width="300">
                      <h1 class="mt-4">Welcome</h1>
                      <div class="maintenance-text w-75 mx-auto mt-4">
                        <!-- <p>Ice cream caramels lemon drops candy. Cake toffee topping cookie tart wafer gummies. Sweet -->
                          <!-- gummi bears jujubes bonbon gingerbread apple pie marshmallow.</p> -->
                      </div>
                      <a href="{{ route('seller.add_store') }}" class="btn gradient-pomegranate big-shadow">Add Store</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </section>
          <!--Under Maintenance Starts-->

        </div>
@endsection