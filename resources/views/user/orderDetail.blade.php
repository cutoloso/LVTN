@extends('layouts.master')
@section('header.title','Trang tài khoản')
@section('header.css')

@endsection

@section('body.content')
    <section id="my-account">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="usr-row">
                        <div class="left">
                            @include('user.sidebar')
                        </div>
                        <div class="right">
                            <h1 class="title mb-4">Chi tiết đơn hàng #{!! $order->id !!}</h1>
                            <div class="order-info">
                                <div class="info">
                                    <p class="info-title">
                                        Thông tin người nhận
                                    </p>
                                    <div class="content">
                                        <div class="">
                                            <p class="name">{{$order->name}}</p>
                                            <p>
                                                <span>Địa chỉ: </span>{{$order->address}}
                                            </p>
                                            <p>
                                                <span>Điện thoại: </span>{{$order->phone}}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="payment">
                                    <p class="payment-title">
                                        Thông tin thanh toán
                                    <div class="content">
                                        <p>{{$order->pay_mth_name}}</p>
                                        <p><span>Trạng thái: </span><span class="@if($order->pay_sta_id == 2 ) {!! "text-success" !!} @else {!! "text-danger" !!} @endif">{{$order->pay_sta_name}}</span></p>
                                    </div>
                                </div>
                            </div>
                            <div class="order-detail">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th>Sản phẩm</th>
                                            <th>Giá</th>
                                            <th>Số lượng</th>
                                            <th>Giảm giá</th>
                                            <th>Tạm tính</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($order->orderDetail as $item)
                                            <tr>
                                                <td>
                                                    <img class="img-fluid thumb"
                                                         src="{{env('ADMIN_URL')}}/storage/products/{{$item->pro_img}}"
                                                         width="130" height="182"
                                                         alt=" {{$item->pro_name}}">
                                                    <div class="product-info">
                                                        <a class="name"
                                                           href="{{route('get-single',$item->id)}}">
                                                            {{$item->pro_name}}</a>
                                                        <p class="ncc">Cung cấp bởi <a
                                                                href="{{route('filter',['bra_id' => $item->bra_id])}}" target="_blank">{{$item->bra_name}}</a>
                                                        </p>
                                                        <p>Sku:  {{$item->pro_code}}</p>
                                                    </div>
                                                </td>
                                                <td><?php echo number_format($item->price)?> ₫</td>
                                                <td>
                                                    {{$item->quantity}}
                                                </td>
                                                <td><?php echo number_format($item->price - $item->price_sale)?> ₫</td>

                                                <td><?php echo number_format($item->price_sale)?> ₫</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                        <tfoot>
                                        <tr>
                                            <td colspan="4" class="">
                                                <span>Tạm tính</span>
                                            </td>
                                            <td><?php echo number_format($order->total_price)?> ₫</td>
                                        </tr>
                                        <tr>
                                            <td colspan="4"><span>Tổng cộng</span></td>
                                            <td><span class="sum"><?php echo number_format($order->total_price)?> ₫</span></td>
                                        </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

@endsection

@section('js')
    <script>
        // Chỉ cho nhập số vào field số điện thoại
        // function validatePhone() {
        //     var num = $('#phone').val();
        //     if (isNaN(num) || num.length < 10) {
        //         $("#validate-phone").text("Số điện thoại nhập không chính sác. Vui lòng nhập lại.");
        //         $('.btn-submit').addClass('disabled');
        //     } else {
        //         $("#validate-phone").text('');
        //         $('.btn-submit').removeClass('disabled');
        //     }
        // }
        // function validatePassWd(){
        //     var input = new String($(this).val());
        //     if (input.length < 6 || input.length > 32){
        //         $(this).parent().children('.validate');
        //     }
        //     else {
        //         $(this).parent().children('.validate').hide();
        //     }
        // }
        function validate() {
            let flag = true;
            let num = $('#phone').val();
            let phone = $("#validate-phone");
            let passwd = $('#new_password');
            let editPw = $('#editPasswd');
            if (isNaN(num) || num.length < 10) {
                phone.text("Số điện thoại nhập không chính sác. Vui lòng nhập lại.");
                flag = false;
            }
            if (editPw.is(':checked')) {
                if (passwd.val().length < 6 || passwd.val().length > 32) {
                    $('.validate-pass').text('Mật khẩu từ 6 đến 32 ký tự');
                    flag = false;
                }
            }
            return flag;

        }

        $(document).ready(function () {
            $('#new_password, #re_new_password').on('keyup', function () {
                if ($('#new_password').val() === $('#re_new_password').val()) {
                    $('#invalid-passwd').html('');
                } else
                    $('#invalid-passwd').html('Mật khẩu không chính xác').css('color', 'red');
            });
        });
    </script>
@endsection
