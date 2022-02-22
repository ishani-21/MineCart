@extends('Seller.layouts.master')
@section('content')
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
</style>
@endpush
<div class="content-overlay"></div>
<div class="content-wrapper">
    <section class="users-edit">
        <div class="row">
            <div class="col-9">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title"><b>Store</b></h3>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                        </div>
                        <div class="table-responsive">
                            <table class="table">
                                <tr>
                                    <th>Store Name:</th>
                                    <td>
                                        <div class="row">
                                            <div class="col-4">
                                                <p><b>English:</b></p>
                                                <p>{{ $showStore->en_name }}</p>
                                            </div>
                                            <div class="col-4">
                                                <p><b>Arabic:</b></p>
                                                <p>{{ $showStore->ar_name }}</p>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Email</th>
                                    <td>{{ $showStore->email }}</td>
                                </tr>
                                <tr>
                                    <th>Description:</th>
                                    <td>
                                        <div class="row">
                                            <div class="col-6">
                                                <p><b>English:</b></p>
                                                <div class="data-editor">
                                                    <div class="post-content text">
                                                        {!! $showStore['en_description'] !!}
                                                    </div>
                                                    <div class="txtcol"><a>Show More</a></div>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <p><b>English:</b></p>
                                                <div class="data-editor">
                                                    <div class="post-content text">
                                                        {!! $showStore['ar_description'] !!}
                                                    </div>
                                                    <div class="txtcol"><a>Show More</a></div>
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
            $(this).parent().find(".post-content").css("max-height", $(this).parent().find(".post-content")[0]
                .scrollHeight);
            $(this).children('a').text("Show Less");
        } else {
            $(this).parent().find(".post-content").css("max-height", "75px");
            $(this).children('a').text("Show More");
        }
        $(this).prev().toggleClass("truncate");
    });
</script>
@endpush