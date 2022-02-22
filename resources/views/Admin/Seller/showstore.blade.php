@extends('Admin.layouts.master')
@section('title', 'Category')
@section('content')<div class="content-overlay"></div>
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12">
            <a href="{{route('admin.Category.categoryindex')}}"><div class="content-header">Store</div></a>
            </div>

            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Show store of <b>{{$seller[0]['fname']}}&nbsp;{{$seller[0]['lname']}}&nbsp;</b></h4>
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
                                        <th>saller</th>
                                        <th>email</th>
                                        <th>English discription</th>
                                        <th>Arrabic discription</th>
                                        <th>status</th>
                                        <th>aproove</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 1;
                                    ?>
                                    @foreach($store as $stor)
                                    <tr>
                                        <td>{{$i}}<?php $i++;?></td>
                                        <td>{{$stor->en_name}}</td>
                                        <td>{{$stor->ar_name}}</td>
                                        <td>{{$stor->saller_id}}</td>
                                        <td>{{$stor->email}}</td>
                                        <td>{{$stor->en_description}}</td>
                                        <td>{{$stor->ar_description ?? 'null'}}</td>
                                        <td>{{$stor->status}}</td>
                                        <td>{{$stor->is_approve}}</td>
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