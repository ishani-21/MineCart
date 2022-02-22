@extends('Seller.layouts.master')
@section('title', 'Seller-Dashbboard')
@section('content')
    <div class="content-overlay"></div>
    <div class="content-wrapper">
        <!--Statistics cards Starts-->
        <div class="row">
            <div class="col-xl-3 col-lg-6 col-md-6 col-12">
                <div class="card gradient-purple-love">
                    <div class="card-content">
                        <div class="card-body py-0">
                            <div class="media pb-1">
                                <div class="media-body white text-left">
                                    <h3 class="font-large-1 white mb-0">{{$store}}</h3>
                                    <span>Total Stores</span>
                                </div>
                                <div class="media-right white text-right">
                                    <i class="fa fa-shopping-basket font-large-1"></i>
                                </div>
                            </div>
                        </div>
                        <div id="" class="height-75 WidgetlineChart WidgetlineChartshadow mb-2">
                        </div>
                    </div>
                </div>
            </div>&nbsp;&nbsp;&nbsp;&nbsp;
            <div class="col-xl-3 col-lg-6 col-md-6 col-12">
                <div class="card gradient-ibiza-sunset">
                    <div class="card-content">
                        <div class="card-body py-0">
                            <div class="media pb-1">
                                <div class="media-body white text-left">
                                    <h3 class="font-large-1 white mb-0">{{$brandCount}}</h3>
                                    <span>Total Selected Brand</span>
                                </div>
                                <div class="media-right white text-right">
                                    <i class="fa fa-superpowers font-large-1"></i>
                                </div>
                            </div>
                        </div>
                        <div id="" class="height-75 WidgetlineChart WidgetlineChartshadow mb-2">
                        </div>

                    </div>
                </div>
            </div>&nbsp;&nbsp;&nbsp;&nbsp;

            <div class="col-xl-3 col-lg-6 col-md-6 col-12">
                <div class="card gradient-mint">
                    <div class="card-content">
                        <div class="card-body py-0">
                            <div class="media pb-1">
                                <div class="media-body white text-left">
                                    <h3 class="font-large-1 white mb-0">{{$category}}</h3>
                                    <span>Total Category</span>
                                </div>
                                <div class="media-right white text-right">
                                    <i class="ft-list font-large-1"></i>
                                </div>
                            </div>
                        </div>
                        <div id=""
                            class="height-75 WidgetlineChart WidgetlineChartshadow mb-2">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--Statistics cards Ends-->

    </div>

    <script>
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
@endsection
