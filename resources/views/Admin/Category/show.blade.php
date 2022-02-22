@extends('Admin.layouts.master')
@section('title', 'Category')
@section('content')
<div class="content-overlay"></div>
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12">
            <a href="{{route('admin.Category.categoryindex')}}"><div class="content-header">Show Category</div></a>
            </div>
            <div class="col-9">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Name: </h4>
                    </div>
                    <div class="card-content">
                    <!--Add borders-->
                        <div class="card-body">
                            <!-- <div class="card-text my-1">
                                <p class="bd-lead">Use border utilities to quickly style the border and border-radius of an element. Great for images, buttons, or any other element.</p>
                                <h6 class="my-1">Add border</h6>
                                <p>Add one of these to class to add border on the required side.</p>
                            </div> -->
                        </div>
                        <div class="table-responsive">
                            <table class="table">
                            <thead>
                                <tr>
                                    <th>English</th>
                                    <th>Arrabic</th>
                                    <th>Category Commission</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{$data->en_name}}</td>
                                    <td>{{$data->ar_name}}</td>
                                    <td>{{$data->commission}}</td>
                                </tr>
                            </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="card">
                    <img style="height: 229px; width: 248px;" class="rounded" src="{{$data->image}}"></img>
                </div>
            </div>

            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Subcategory of {{$data->en_name}}&nbsp;(&nbsp;{{ $data->ar_name }}&nbsp;)</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>English</th>
                                        <th>Arrabic</th>
                                        <th>Image</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 1;
                                    ?>
                                    @foreach($subcategory as $sub)
                                    <tr>
                                        <td>{{$i}}<?php $i++;?></td>
                                        <td>{{$sub->en_name}}</td>
                                        <td>{{$sub->ar_name}}</td>
                                        <td><img style="height: 43px;" class="rounded" src="{{$sub->image}}"></img></td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
