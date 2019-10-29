@extends('layouts.master')
@section('header.title','Trang chủ')
@section('header.css')
    <style>

    </style>
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
                                        <a href="javascript:" data-id="{{$item_sale->id}}" class="add-cart"><i class="fas fa-cart-plus"></i></a>
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
                                        <span class="star" style="width: {{($item_sale->avgStar/5)*100}}%"></span>({{$item_sale->totalReview}})
                                    </div>
                                    <a href="">
                                        <div class="product-name">
                                            {{$item_sale->name}}
                                        </div>
                                    </a>

                                    <div class="product-price">
                                        @if($item_sale->price_sale =='')
                                            @php echo number_format($item_sale->price).'₫'; @endphp
                                        @else
                                            @php echo number_format($item_sale->price_sale).'₫'; @endphp
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
                                        <a href="javascript:" data-id="{{$item_feature->id}}" class="add-cart"><i class="fas fa-cart-plus"></i></a>
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
                                        <span class="star" style="width: {{($item_sale->avgStar/5)*100}}%"></span> ({{$item_sale->totalReview}})
                                    </div>
                                    <div class="product-name">
                                        <a href="">{{$item_feature->name}}</a>
                                    </div>
                                    <div class="product-price">
                                        @php echo number_format($item_feature->price_sale).'₫'; @endphp
                                    </div>
                                    <div class="group-button">
                                        <div class="inner">
                                            <a href="javascript:" data-id="{{$item_feature->id}}" class="add-cart">Thêm vào giỏ</a>
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

        });

    </script>
@endsection
