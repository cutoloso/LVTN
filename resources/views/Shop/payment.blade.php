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
                                        <div class="product-thumb">
                                            <img src="{{env('ADMIN_URL')}}/storage/products/{{$cartProduct->options->img}}" alt="" class="img-fluid">
                                        </div>
                                        <span class="quantity">{{$cartProduct->qty}} x </span>
                                        <span class="product-title">&nbsp{{$cartProduct->name}}</span>
                                    </div>
                                    <div class="right price">
                                        <?php echo number_format($cartProduct->options->price_sale*$cartProduct->qty)?> ₫
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
                            <span class="title">Tổng tiền</span> <span class="price"><?php echo number_format(getTotalPrice())?> ₫ </span>
                        </div>
                    </div>

                </div>
                <div class="col-12">
                    <form action="{{route('order.store')}}" method="POST">
                        @csrf
                        <input type="hidden" name="pay_mth_id" value="1">
                        <input type="hidden" name="pay_sta_id" value="1">
                        <input type="hidden" name="name" value="{{$customer->name}}">
                        <input type="hidden" name="address" value="{{$customer->address}}">
                        <input type="hidden" name="phone" value="{{$customer->phone}}">

                        <div class="btn-group">
                            <button class="btn btn-buy" type="submit">Thanh toán khi nhận hàng <br><span> (COD)</span></button>
                            <button class="btn btn-paypal hidden js-paypal" id="paypal-button" ></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

@endsection

@section('js')
    <script src="{{asset('js/money.min.js')}}"></script>
    <script>
        $(document).ready(function () {
            $.get("http://www.dongabank.com.vn/exchange/export", function(data, status){
                alert("Data: " + data + "\nStatus: " + status);
            });
        });
    </script>
    <script src="https://www.paypalobjects.com/api/checkout.js"></script>

    <script>
        paypal.Button.render({
            env: 'sandbox',
            style: {
                color:  'blue',
                shape:  'rect',
                label:  'paypal',
                height: 54.5,
                tagline : false,
                size:'responsive',
            },

            funding: {
                allowed: [
                    paypal.FUNDING.CARD,
                    // paypal.FUNDING.CREDIT
                ],
                disallowed: []
            },

            client: {
                sandbox: 'AWeIH7_vpsmqz3qC3gaKULxN-zSdxltwmaDY9YuCgbEYbKynkteDSWWTVdvh-aJflBP346pcNVoWQJC4',
                production: ''
            },


            payment: function(data, actions) {
                return actions.payment.create({
                    "transactions": [
                        {
                            "amount": {
                                "total": "{!! getCurrency(getTotalPrice()) !!}",
                                "currency": "USD",
                            },
                            "description": "The payment transaction description.",
                            "payment_options": {
                                "allowed_payment_method": "INSTANT_FUNDING_SOURCE"
                            },
                            "soft_descriptor": "ECHI5786786",
                            "item_list": {
                                "items": [
                                    {
                                        "name": "Tổng số tiền của hóa đơn",
                                        "quantity": "1",
                                        "price": "{!! getCurrency(getTotalPrice()) !!}",
                                        "currency": "USD"
                                    },
                                ],
//	                        "shipping_address": {
//	                          "recipient_name": "Brian Robinson",
//	                          "line1": $scope.shipping.address,
//	                          "line2": "Unit #34",
//	                          "city": $scope.shipping.address,
//	                          "country_code": "US",
//	                          "postal_code": "95131",
//	                          "phone": $scope.shipping.phone,
//	                          "state": "CA"
//	                        }
                            }
                        }
                    ]
                });
            },


            onAuthorize: function (data, actions) {
                return actions.payment.execute()
                    .then(function () {
                        //Hình thức thanh toán bằng paypal id bằng 2
                        //
                        $.ajax({
                            url: "{{route('order.store')}}",
                            method: "POST",
                            data: {
                                pay_mth_id: 2,
                                pay_sta_id: 2,
                                name: "{{$customer->name}}",
                                address: "{{$customer->address}}",
                                phone: "{{$customer->phone}}",
                                _token : "{{ csrf_token() }}"
                            },
                            success: function () {
                                location.replace("{{route('get-cart')}}");
                            }
                        });

                    });
            }
        }, '#paypal-button');
    </script>
@endsection
