@extends('Admin.layouts.master')
@section('title', 'Product')
@section('content')
<div class="content-overlay"></div>
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12">
            <a href="{{route('admin.Category.categoryindex')}}"><div class="content-header">Show Product</div></a>
            </div>
            <div class="col-9">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Basic information : </h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                        </div>
                        <div class="table-responsive">
                            <table class="table">
                            <tbody>
                                <tr>
                                    <th>Store :</th>
                                    <td><p><b>English</b></p><p>{{$data->stores->en_name}}</p></td>
                                    <td><p><b>Arrabic</b></p><p>{{$data->stores->ar_name}}</p></td>
                                </tr>
                                <tr>
                                    <th>Category :</th>
                                    <td><p><b>English</b></p><p>{{$data->Category->en_name}}</p></td>
                                    <td><p><b>Arrabic</b></p><p>{{$data->Category->ar_name}}</p></td>
                                </tr>
                                <tr>
                                    <th>Brand :</th>
                                    <td><p><b>English</b></p><p>{{$data->Brand->en_name}}</p></td>
                                    <td><p><b>Arrabic</b></p><p>{{$data->Brand->ar_name}}</p></td>
                                </tr>
                            </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="card">
                    <img style="height: 230px; width: 250px;" class="rounded" src="{{$data->cover_image}}"></img>
                </div>
            </div>

            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">{{$data->en_productname}}&nbsp;(&nbsp;{{$data->ar_productname }}&nbsp;) information</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                        </div>
                            <div class="table-responsive">
                                <table class="table break-table">
                                    <tbody>
                                    <tr>
                                        <th>Name :</th>
                                        <td><p><b>English </b></p><p>{{$data->en_productname}}</p></td>
                                        <td><p><b>Arrabic </b></p><p>{{$data->en_productname}}</p></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <th>Price :</th>
                                        <td><p><b>Cost </b></p><p>{{$data->cost_price}}</p></td>
                                        <td><p><b>Regular </b></p><p>{{$data->regular_price}}</p></td>
                                        <td><p><b>Sale </b></p><p>{{$data->sale_price}}</p></td>
                                    </tr>
                                    <tr>
                                        <th>Discription :</th>
                                        <td>
                                            <p><b>English </b></p>
                                            <div class="desc-table">
                                                <p>{{$data->en_discription}}</p>
                                            </div>
                                        </td>
                                        <td>
                                            <p><b>Arrabic </b></p>
                                            <div class="desc-table">
                                                <p>{{$data->ar_discription}}</p>
                                            </div>
                                        </td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <th>Status :</th>
                                        <td>
                                            <p><b>Status </b></p>
                                            @if($data->status == '1')
                                                <p><span class="badge badge-pill-sm badge-danger">Inactive</span></p>
                                            @else
                                                <p><span class="badge badge-pill-sm badge-success">Active</span></p>
                                            @endif
                                        </td>
                                        <td>
                                            <p><b>Approve</b></p>
                                            @if($data->is_approve == '0')
                                                <p><span class="badge badge-pill-sm badge-secondary">Pending <i class="fa fa-exclamation-triangle" aria-hidden="true"></i></span></p>
                                            @elseif($data->is_approve == '1')
                                                <p><span class="badge badge-pill-sm badge-success">Approve <i class="fa fa-check" aria-hidden="true"></i></span></p>
                                            @else
                                                <p><span class="badge badge-pill-sm badge-danger">Rejected <i class="fa fa-times" aria-hidden="true"></i></span></p>
                                            @endif
                                        </td>
                                        <td></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                    </div>
                </div>
            </div>
            <!-- <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">{{$data->en_productname}}&nbsp;(&nbsp;{{$data->ar_productname }}&nbsp;) Multiple images</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                        </div>
                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div> -->
        </div>
    </div>
@endsection
