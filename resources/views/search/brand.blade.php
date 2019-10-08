@extends('layouts.master')
@section('header.title','Search')
@section('header.css')

@endsection

@section('body.content')
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
                                            <a class="thumb-link" href="single-product.html">
                                                <img src="{{env('ADMIN_URL')}}/storage/products/{{$item_feature->img}}" alt="">
                                            </a>
                                        </div>
                                        <div class="group-button-mobile">
                                            <a href="#" class="add-cart">Thêm vào giỏ</a>
                                            <a href="#" class="compare">
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
                                            {{$item_feature->price}}₫
                                        </div>
                                        <div class="group-button">
                                            <div class="inner">
                                                <a href="#" class="add-cart">Thêm vào giỏ</a>
                                                <a href="#" class="compare">
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

@endsection
