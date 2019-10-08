@extends('layouts.master')
@section('header.title','Giỏ hàng')
@section('header.css')

@endsection

@section('body.content')
<?php //dd($cartProducts)?>
    <section id="notifi">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    {{-- Hiển thị thông tin trạng thái tạo bài viết --}}
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <strong>{{session('success')}}</strong>
                        </div>
                    @elseif (session('false'))
                        <div class="alert alert-danger alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <strong>{{session('false')}}</strong>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
    <section id="cart">
        <div class="container">
            <div class="row" style="display: none">
                <div class="col-12">
                    <div class="alert alert-danger">Mã giảm giá "DFSQAFDAD" không hợp lệ (chương trình khuyến mãi tương ứng không tồn tại)</div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 title-header">
                    Giỏ hàng <span>(@php echo getCountCart(); @endphp sản phẩm)</span>
                </div>
            </div>
            <div class="row">
                <div class="@if(getCountCart()>0) col-xl-9 col-md-8 @endif col-12">
                    <div class="cart-info">
                        @foreach($cartProducts as $product)
                            <div class="row cart-items">
                                <div class="col-4 col-sm-3 col-lg-2 img-thumb">
                                    <img src="{{env('ADMIN_URL')}}/storage/products/{{$product->options->img}}" alt="" class="img-responsive">
                                </div>
                                <div class="col-6 col-sm-9 col-lg-10 info">
                                    <div class="box-info-product">
                                        <div class="col-left">
                                            <a class="name" href="{{route('get-single',$product->id)}}">{{$product->name}}</a>
                                            <div class="brand">Nhãn hiệu: <span>{{$product->options->bra_name}}</span></div>
                                            <div class="action">
                                                <a href="{{route('delete-cart-item',$product->rowId)}}" class="btn btn-danger js-del-item" data-id="{{$product->id}}">Xóa</a>
                                            </div>
                                        </div>
                                        <div class="col-right">
                                            <div class="box-price">
                                                <div class="price-sale"><?php echo priceToString($product->options->price_sale*$product->qty)?> ₫</div>
                                                @if($product->options->price_sale!=$product->price)
                                                    <div class="primary-price"><?php echo priceToString($product->price*$product->qty)?> ₫
                                                        <span class="sale">-{{100 - round((($product->options->price_sale*$product->qty)/($product->price*$product->qty))*100)}}%</span>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="box-quatity input-group">
                                                <span><button class="btn quantity-minus">-</button></span>
                                                <input data-rowid="{{$product->rowId}}" class="input-qty" type="text" value="{{$product->qty}}" data-min="1" data-max="3" readonly data-step="1">
                                                <span><button class="btn quantity-plus">+</button></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        @if(getCountCart()==0)
                            <div class="empty-cart">
                                <span class="mascot-image"></span>
                                <p class="message">Không có sản phẩm nào trong giỏ hàng của bạn.</p>
                                <a href="/" class="btn btn-home">Tiếp tục mua sắm</a>
                            </div>
                        @endif
                    </div>
                </div>
                @if(getCountCart()>0)
                <div class="col-xl-3 col-md-4 col-12">
                    <div class="cart-price">
                        <div class="total-price">
                            <span class="label">Tổng: </span><?php echo priceToString(getTotalPrice())?> ₫
                        </div>
                    </div>
                    <a class="btn btn-checkout" href="{{route('get-checkout')}}">Tiến hành đặt hàng</a>
                    <div class="code-sale" style="display: none">
                        <div class="title">Mã giảm giá / Quà tặng</div>
                        <div class="input-group">
                            <input type="text">
                            <span><button class="btn">Đồng ý</button></span>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </section>
@endsection

@section('js')
    <script>
        $(document).ready(function () {
            $('.quantity-minus').click(function () {
                let parent = $(this).parents('.input-group');
                let value_min = parseInt(parent.children('.input-qty').data('min'));
                let value_step = parseInt(parent.children('.input-qty').data('step'));
                let value = parseInt(parent.children('.input-qty').val());
                if (value > value_min) {
                    parent.children('.input-qty').val(value - value_step);
                    let rowId = parent.children('.input-qty').data('rowid');
                    let ulr = "update-cart-item/"+rowId;
                    console.log(rowId);
                    $.ajax({
                        url: ulr,
                        method: "PUT",
                        data:{
                            _token: "{{csrf_token()}}",
                            qty: parent.children('.input-qty').val()
                        },
                        beforeSend:function () {

                        },
                        success: function (response) {
                            location.reload();
                        }
                    });
                }
            });

            $('.quantity-plus').click(function () {
                let parent = $(this).parents('.input-group');
                let value_step = parseInt(parent.children('.input-qty').data('step'));
                let value_max = parseInt(parent.children('.input-qty').data('max'));
                let value = parseInt(parent.children('.input-qty').val());
                if (value < value_max){
                    parent.children('.input-qty').val(value + value_step);
                    let rowId = parent.children('.input-qty').data('rowid');
                    let ulr = "update-cart-item/"+rowId;
                    console.log(rowId);
                    $.ajax({
                        url: ulr,
                        method: "PUT",
                        data:{
                            _token: "{{csrf_token()}}",
                            qty: parent.children('.input-qty').val()
                        },
                        beforeSend:function () {

                        },
                        success: function (response) {
                            location.reload();
                        }
                    });
                }
            });

            $('.add-cart').click(function () {
                let htmlString = $( this ).html();
                $(this).html('<div class="ajax-loading"></div>');


                let id = $(this).data('id');
                let url = $(this).data('url');
                $.ajax({
                    method: "GET",
                    url: url,
                    data:{
                        _token : "{{ csrf_token() }}"
                    },
                    beforeSend: function () {

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
                        }, 1000);
                    }
                });

            });

        });
    </script>
@endsection
