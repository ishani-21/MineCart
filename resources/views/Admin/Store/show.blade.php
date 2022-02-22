@extends('Admin.layouts.master')
@section('title', 'Category')
@push('css')
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet" />
@endpush
@section('content')
<div class="content-overlay"></div>
<div class="content-wrapper">
    <div class="row">
        <div class="col-12">
            <a href="{{route('admin.Category.categoryindex')}}">
                <div class="content-header">Show Stor</div>
            </a>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title"><b>Store Record : </h4>
                </div>
                <div class="card-content">
                    <div class="card-body">
                    </div>
                    <div class="table-responsive">
                        <table class="table break-table">
                            <tbody>
                                <tr>
                                    <th>Name :</th>
                                    <td>
                                        <p><b>English : </b></p>
                                        <p class="font-weight-light">{{$data->en_name}}</p>
                                    </td>
                                    <td>
                                        <p><b>Arrabic</b></p>
                                        <p class="font-weight-light">{{$data->ar_name}}</p>
                                    </td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th>Seller Name :</th>
                                    <td class="font-weight-light">{{$data->saller->fname}}&nbsp;{{$data->saller->lname}}</td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th>Email :</th>
                                    <td class="font-weight-light">{{$data->email}}</td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th>Description :</th>
                                    <td>
                                        <p><b>English : </b></p>
                                        <p class="font-weight-light">{{$data->en_description}}</p>
                                    </td>
                                    <td>
                                        <p><b>Arrabic : </b></p>
                                        <p class="font-weight-light">{{$data->ar_description}}</p>
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
    </div>
</div>

@endsection