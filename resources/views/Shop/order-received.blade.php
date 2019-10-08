@extends('layouts.master')
@section('header.title','Giỏ hàng')
@section('header.css')

@endsection

@section('body.content')

    <section id="order-received">
        <div class="container">
            <div class="row">
                <div class="col-6">
                    <div class="order-info card">
                            <div class="card-header title">Chi tiết đơn hàng</div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <tbody>
                                        @foreach($orderProduct as $product)
                                            @php
                                                $price = $product->price*$product->quantity;
                                            @endphp
                                        <tr>
                                            <td>{{$product->name}}  <span>x {{$product->quantity}}</span></td>
                                            <td><?php echo priceToString($price)?> ₫</td>
                                        </tr>
                                        @endforeach
                                        <tr>
                                            <th>Phương thức thanh toán:</th>
                                            <td>{{$order->pay_name}}</td>
                                        </tr>
                                        </tbody>
                                        <tfoot>
                                        <tr>
                                            <th>Tổng:</th>
                                            <td><?php echo priceToString($order->total_price)?> ₫</td>
                                        </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                </div>
                <div class="col-6">
                    <div class="card order-checkout">
                        <div class="card-header title">Địa chỉ thanh toán</div>
                        <div class="card-body content">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <tbody>
                                    <tr>
                                        <td>Họ và tên: {{$order->name}}</td>
                                    </tr>
                                    <tr>
                                        <td>Địa chỉ: {{$order->address}}</td>
                                    </tr>
                                    <tr>
                                        <td>Số điện thoại: {{$order->phone}}</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-8 offset-md-2">
                    <div class="card order-info-cus">
                        <div class="card-header title">Chi tiết hóa đơn</div>
                        <div class="card-body content">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <tbody>
                                    <tr>
                                        <td>MÃ ĐƠN HÀNG:</td>
                                        <th>{{$order->id}}</th>
                                    </tr>
                                    <tr>
                                        <td>NGÀY:</td>
                                        <th>{{$order->created_at}}</th>
                                    </tr>
                                    <tr>
                                        <td>Email</td>
                                        <th>{{ Auth::user()->email}}</th>
                                    </tr>
                                    <tr>
                                        <td>TỔNG CỘNG:</td>
                                        <th><?php echo priceToString($order->total_price)?> ₫</th>
                                    </tr>
                                    <tr>
                                        <td>PHƯƠNG THỨC THANH TOÁN:</td>
                                        <th>{{$order->pay_name}}</th>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 text-center">
                    <div class="h5 text-center mt-5 text-success">Cảm ơn bạn. Đơn hàng của bạn đã được nhận.</div>
                    <a href="{{env('APP_URL')}}" class="btn btn-primary mt-3 thanks">TIẾP TỤC MUA SẮM</a>
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
