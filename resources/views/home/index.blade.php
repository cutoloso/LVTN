@extends('layouts.master')
@section('header.title','Trang chủ')
@section('header.css')

@endsection

@section('body.content')
    <section id="slider-main">
        <div class="container">
            <div class="row">
                <div class="col-12  owl-carousel owl-theme slider-content">
                    @foreach($banners as $banner)
                    <div class="slider-item">
                        <img src="{{env('ADMIN_URL')}}/storage/banners/{{$banner->img}}" alt="banner">
                        <a href="{{$banner->link}}" class="btn-shopping">Mua ngay</a>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <section id="best-seller" class="product-outer">
        <div class="container product-wrapper">
            <div class="row">
                <div class="col-12">
                    <div class="head">
                        <div class="title">
                            Sản phẩm bán chạy
                        </div>
                        <ul class="navigat">
                            <li href="/dtdd" class="active"><a>All</a></li>
                            <li href="/dtdd-apple"><a>Apple</a></li>
                            <li href="/dtdd-samsung"><a>Samsung</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row  product-wrapper">
                <div class="col-12">
                    <div class="list-product owl-carousel">

                        @foreach($best_sale as $item_sale)
                        <div class="product-item">
                            <div class="product-inner">
                                <div class="product-thumb">
                                    <div class="thumb-inner">
                                        <a class="thumb-link" href="{{route('get-single',$item_sale->id)}}">
                                            <img src="{{env('ADMIN_URL')}}/storage/products/{{$item_sale->img}}" alt="">
                                        </a>
                                    </div>
                                    <div class="group-button-mobile">
                                        <a href="javascript:" data-id="{{$item_sale->id}}" class="add-cart">Thêm vào giỏ</a>
                                        <a href="javascript:" data-id="{{$item_sale->id}}" class="btn-compare">
                                            <i class="fas fa-exchange-alt"></i>
                                        </a>
                                        <a href="#" class="add_wishlist">
                                            <i class="far fa-heart"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="product-info">
                                    <div class="star-rating">
                                        <span class="star" style="width: 80%"></span>
                                    </div>
                                    <a href="">
                                        <div class="product-name">
                                            {{$item_sale->name}}
                                        </div>
                                    </a>

                                    <div class="product-price">
                                        @if($item_sale->price_sale =='')
                                            {{$item_sale->price}}₫
                                        @else
                                            {{$item_sale->price_sale}}₫
                                        @endif
                                    </div>
                                    <div class="group-button">
                                        <div class="inner">
                                            <a href="javascript:" data-id="{{$item_sale->id}}" class="add-cart">Thêm vào giỏ</a>
                                            <a href="javascript:" data-id="{{$item_sale->id}}" class="btn-compare">
                                                <i class="fas fa-exchange-alt"></i>
                                            </a>
                                            <a href="#" class="add_wishlist">
                                                <i class="far fa-heart"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="phone-feature" class="product-outer">
        <div class="container  product-wrapper">
            <div class="row">
                <div class="col-12">
                    <div class="head">
                        <div class="title">
                            Điện thoại nổi bật
                        </div>
                        <ul class="navigat">
                            <li class="active"><a href="#">All</a></li>
                            <li><a href="#">Apple</a></li>
                            <li><a href="#">Samsung</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row  product-wrapper">
                <div class="col-12">
                    <div class="list-product owl-carousel">
                        @foreach($best_feature as $item_feature)
                        <div class="product-item">
                            <div class="product-inner">
                                <div class="product-thumb">
                                    <div class="thumb-inner">
                                        <a class="thumb-link" href="{{route('get-single',$item_feature->id)}}">
                                            <img src="{{env('ADMIN_URL')}}/storage/products/{{$item_feature->img}}" alt="">
                                        </a>
                                    </div>
                                    <div class="group-button-mobile">
                                        <a href="javascript:" class="add-cart">Thêm vào giỏ</a>
                                        <a href="javascript:" data-id="{{$item_feature->id}}" class="btn-compare">
                                            <i class="fas fa-exchange-alt"></i>
                                        </a>
                                        <a href="#" class="add_wishlist">
                                            <i class="far fa-heart"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="product-info">
                                    <div class="star-rating">
                                        <span class="star" style="width: 80%"></span>
                                    </div>
                                    <div class="product-name">
                                        <a href="">{{$item_feature->name}}</a>
                                    </div>
                                    <div class="product-price">
                                        @if($item_feature->price_sale =='')
                                            {{$item_feature->price}}₫
                                        @else
                                            {{$item_feature->price_sale}}₫
                                        @endif
                                    </div>
                                    <div class="group-button">
                                        <div class="inner">
                                            <a href="javascript:" class="add-cart">Thêm vào giỏ</a>
                                            <a href="javascript:" data-id="{{$item_feature->id}}" class="btn-compare">
                                                <i class="fas fa-exchange-alt"></i>
                                            </a>
                                            <a href="#" class="add_wishlist">
                                                <i class="far fa-heart"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('js')
    <script>
        $(document).ready(function () {
            $('.add-cart').click(function () {
                let htmlString = $( this ).html();
                $(this).html('<div class="ajax-loading"></div>');

                let id = $(this).data('id');
                $.ajax({
                    method: "GET",
                    url: 'add-to-cart/'+id,
                    data:{
                        _token : "{{ csrf_token() }}"
                    },
                    beforeSend: function () {
                        $('#header .header2 .header2-content .header2-control .icon .count').removeClass('heartBeat');
                    },
                    success: function (response) {
                        setTimeout(function(){
                            $('#header .header2 .header2-content .header2-control .icon .count').text(response.cartCount);
                            $('.add-cart').html(htmlString);
                            $('body,html').animate({
                                    scrollTop: 0,
                                }, 500
                            );
                            $('#header .header2 .header2-content .header2-control .icon .count').addClass('heartBeat');
                        }, 500);
                    }
                });

            });



        });

    </script>
@endsection
