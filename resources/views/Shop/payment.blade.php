@extends('layouts.master')
@section('header.title','Thanh toán')
@section('header.css')

@endsection

@section('body.content')
    <section id="payment">
        <div class="container">
            <dic class="row">
                <div class="col-12 payment-title">
                    Thông tin thanh toán
                </div>
            </dic>
            <div class="row">
                <div class="col-12">
                    <div class="payment-shipping">
                        <div class="shipping-info">
                        <span class="title">
                            Địa chỉ giao hàng
                        </span>
                            <a href="{{route('get-checkout')}}" class="btn btn-edit-address">Sửa</a>
                        </div>
                        <div class="info">
                            <p><span class="label">Họ và tên: </span><span class="custommer-name">{{$customer->name}}</span></p>
                            <p><span class="label">Địa chỉ: </span><span>{{$customer->address}}</span></p>
                            <p><span class="label">Điện thoại: </span><span>{{$customer->phone}}</span></p>
{{--                            <p><span class="label">Email: </span><span>{{$customer->email}}</span></p>--}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="order">
                        <div class="order-info">
                            <div class="title">
                                Đơn Hàng (@php echo getCountCart(); @endphp sản phẩm)
                            </div>
                            <a href="{{route('get-cart')}}" class="btn btn-edit-order">Sửa</a>
                        </div>
                        <div class="order-list-item">
                            @foreach($cartProducts as $cartProduct)
                                <div class="order-item">
                                    <div class="left">
                                        <span class="quantity">{{$cartProduct->qty}} x </span>
                                        <span class="product-title">{{$cartProduct->name}}</span>
                                    </div>
                                    <div class="right price">
                                        <?php echo priceToString($cartProduct->options->price_sale*$cartProduct->qty)?> ₫
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="order-list-item">
                            <div class="shipping-price order-item">
                                <div class="title left">
                                    Phí vận chuyển
                                </div>
                                <div class="price right">0 ₫</div>
                            </div>
                        </div>
                        <div class="price-total">
                            <span class="title">Tổng tiền</span> <span class="price"><?php echo priceToString(getTotalPrice())?> ₫ </span>
                        </div>
                    </div>

                </div>
                <div class="col-12">
                    <form action="{{route('order.store')}}" method="POST">
                        @csrf
                        <input type="hidden" name="pay_mth_id" value="1">
                        <input type="hidden" name="name" value="{{$customer->name}}">
                        <input type="hidden" name="address" value="{{$customer->address}}">
                        <input type="hidden" name="phone" value="{{$customer->phone}}">

                        <button class="btn btn-buy" type="submit">ĐẶT MUA</button>
                    </form>
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
