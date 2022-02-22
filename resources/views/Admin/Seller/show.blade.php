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
                <div class="content-header">Show Product</div>
            </a>
        </div>
        <div class="col-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Brand information : </h4>
                </div>
                <div class="card-content">
                    <div class="card-body">
                    </div>
                    <div class="table-responsive">
                        <table class="table">
                            <tbody>
                                @if(!empty($brand))
                                <tr>
                                    <th>
                                        <p><b>English</b></p>
                                    </th>
                                    <td>:</td>
                                    @foreach($brand as $b)
                                    <td>{{$b->en_name}}</td>
                                    @endforeach
                                </tr>
                                <tr>
                                    <th>
                                        <p><b>Arrabic</b></p>
                                    </th>
                                    <td>:</td>
                                    @foreach($brand as $b)
                                    <td>{{$b->ar_name}}</td>
                                    @endforeach
                                </tr>
                                @else
                                <tr>
                                    <th>No Brand Selected</th>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Country information : </h4>
                </div>
                <div class="card-content">
                    <div class="card-body">
                    </div>
                    <div class="table-responsive">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <th>Country :</th>
                                    <td>{{optional($view->country_data)->name}}</td>
                                </tr>
                                <tr>
                                    <th>State :</th>
                                    <td>{{optional($view->state_data)->name}}</td>
                                </tr>
                                <tr>
                                    <th>City :</th>
                                    <td>{{optional($view->city_data)->name}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title"><b>{{$view->fname}}&nbsp;{{$view->lname}}</b>&nbsp;information : </h4>
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
                                        <p><b>First name </b></p>
                                        <p>{{$view->fname}}</p>
                                    </td>
                                    <td>
                                        <p><b>Last name</b></p>
                                        <p>{{$view->lname}}</p>
                                    </td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th>Email :</th>
                                    <td>{{$view->email ?? '-'}}</td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th>Mobile :</th>
                                    <td>{{$view->mobile ?? '-'}}</td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th>Business_name :</th>
                                    <td>{{$view->business_name ?? '-'}}</td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th>Website :</th>
                                    <td>{{$view->website ?? '-'}}</td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th>Register Number :</th>
                                    <td>{{$view->register_number ?? '-'}}</td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th>Address :</th>
                                    <td>{{$view->address ?? '-'}}</td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th>Type :</th>
                                    <td>
                                        @if($view->is_type == '1')
                                        <p><span class="badge badge-pill-sm badge-dark">Business Seller</span></p>
                                        @else
                                        <p><span class="badge badge-pill-sm badge-dark">Individual Seller</span></p>
                                        @endif
                                    </td>
                                    <td>
                                        @if($view->is_verify == '1')
                                        <p><span class="badge badge-pill-sm badge-dark">Verified Seller</span></p>
                                        @else
                                        <p><span class="badge badge-pill-sm badge-dark">No Verified Seller</span></p>
                                        @endif
                                    </td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th>Status :</th>
                                    <td>
                                        <p><b>Status </b></p>
                                        @if($view->status == '1')
                                        <p><span class="badge badge-pill-sm badge-danger">Inactive</span></p>
                                        @else
                                        <p><span class="badge badge-pill-sm badge-success">Active</span></p>
                                        @endif
                                    </td>
                                    <td>
                                        <p><b>Approve</b></p>
                                        @if($view->is_approve == '0')
                                        <p><span class="badge badge-pill-sm badge-secondary">Pending <i class="fa fa-exclamation-triangle" aria-hidden="true"></i></span></p>
                                        @elseif($view->is_approve == '1')
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