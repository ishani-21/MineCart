@extends('Seller.layouts.master')
@section('title', 'Seller-Product')
@push('css')
<style>
    .post-content {
        overflow: hidden;
        white-space: normal;
        text-overflow: ellipsis;
        /* line-height: 1.2em; */
        /* max-height = line-height (1.2) * lines max number (3) */
        /* max-height: 3.6em;  */
        max-height: 75px;
        text-align: justify;
    }

    .txtcol {
        display: none;
        color: #aa20fb;
        font-weight: 600;
        position: relative;
        font-size: 12px;
        padding-top: 5px;
        cursor: pointer;
        margin-top: 5px;
    }

    .img-view-box {
            position: relative;
            width: 20%;
            margin-right: 15px;
        }

        .show-img-container {
            display: flex;
            flex-wrap: wrap;
        }


        .img-view-box img {
            width: 100%;
            max-width: 100%;
            border-radius: 6px;
        }

        .img-view-box .img-remove {
            width: 20px;
            height: 20px;
            border-radius: 50%;
            background-color: red;
            color: #fff;
            font-size: 10px;
            position: absolute;
            top: 5px;
            right: 5px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
        }

    </style>
@endpush
@section('content')
    <div class="content-overlay"></div>
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12">
                <a href="{{ route('seller.product.index') }}" style="color:blue;"class="text-decoration-none">
                    <div class="content-header ">Show Product</div>
                </a>
            </div>
            <div class="col-9">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title"><b>Product History</b></h3>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                        </div>
                        <div class="table-responsive">
                            <table class="table">
                                <tr>
                                    <th>Product Name:</th>
                                    <td>
                                        <div class="row">
                                            <div class="col-6">
                                                <p><b>English:</b></p>
                                                <p>{{ $product['product']->en_productname }}</p>
                                            </div>
                                            <div class="col-6">
                                                <p><b>Arabic:</b></p>
                                                <p>{{ $product['product']->ar_productname }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th>Regular Price</th>
                                <td>{{ $product['product']->regular_price }}</td>
                            </tr>
                            <tr>
                                <th>Cost Price</th>
                                <td>{{ $product['product']->cost_price }}</td>
                            </tr>
                            <tr>
                                <th>Sale Price</th>
                                <td>{{ $product['product']->sale_price }}</td>
                            </tr>
                            <tr>
                                <th>Total Quantity</th>
                                <td>{{ $product['product']->total_qty }}</td>
                            </tr>
                            <tr>
                                <th>Available Stock</th>
                                <td>{{ $product['product']->available_stock }}</td>
                            </tr>
                            <tr>
                                <th>Description:</th>
                                <td>
                                    <div class="row">
                                        <div class="col-6">
                                            <p><b>English:</b></p>
                                            <div class="data-editor">
                                                <div class="post-content text">
                                                    {!! $product['product']['en_discription'] !!}
                                                </div>
                                                <div class="txtcol"><a>Show More</a></div>
                                            </div>
                                            </p>
                                        </div>
                                        <div class="col-6">
                                            <p><b>Arabic:</b></p>
                                            <div class="data-editor">
                                                <div class="data-editor">
                                                    <div class="post-content text">
                                                        {!! $product['product']['ar_discription'] !!}
                                                    </div>
                                                    <div class="txtcol"><a>Show More</a></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-3">
            <div class="card">
                <img class="rounded" src={{ $product['product']->cover_image }}>
            </div>
        </div>

        <div class="col-5">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title"><b>category of &nbsp;(Product)</b></h4>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>English Name</th>
                                        <th>Arabic Name</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <td>{{ $product['product']->Category->en_name }}</td>
                                    <td>{{ $product['product']->Category->ar_name }}</td>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-5">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title"><b>Brand of &nbsp;(Product)</b></h4>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>English Name</th>
                                        <th>Arabic Name</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <td>{{ $product['product']->Brand->en_name }}</td>
                                    <td>{{ $product['product']->Brand->ar_name }}</td>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

    <div class="col-12">
        <div class="card">
            <div class="card-content">
                <div class="card-body">
                    <h5 class="card-title "><b>Product Images</h5>
                    <div class="user-profile-stories swiper-container pt-1">
                        <div class="show-img-container">
                            @foreach ($product['images'] as $value)
                                <div class="img-view-box">
                                    <img src="{{ $value['image'] }}"
                                        class="rounded user-profile-stories-image"
                                        onerror="this.style.display='none'" alt="story-image-1">
                                </div>
                            @endforeach
                        </div>
                        {{-- @endforeach

                        @if ($images != null)
                        @foreach ($images as $values)
                        <img src="{{ asset('storage/seller/product/images/' . $values) }}" class="rounded user-profile-stories-image" style="height: 229px; width: 150px;" alt="story-image-1">
                        @endforeach
                        @endif --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('js')
<script>
    $(".post-content").each(function() {
        if ($(this).height() < $(this)[0].scrollHeight) {
            $(this).parent().find(".txtcol").show();
            $(this).toggleClass("truncate");
        }
    });
    $(".txtcol").click(function() {
        if ($(this).prev().hasClass("truncate")) {
            $(this).parent().find(".post-content").css("max-height", $(this).parent().find(".post-content")[0].scrollHeight);
            $(this).children('a').text("Show Less");
        } else {
            $(this).parent().find(".post-content").css("max-height", "75px");
            $(this).children('a').text("Show More");
        }
        $(this).prev().toggleClass("truncate");
    });

         //select store
         $(document).ready(function() {
            $('.store').on('change', function() {
                $('.category').remove();
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
