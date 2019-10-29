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
                            <h1 class="title mb-4">Đơn hàng của tôi</h1>
                            <div class="order-content">
                                <table class="table table-hover table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                    <tr>
                                        <th>Mã đơn hàng</th>
                                        <th>Ngày mua</th>
                                        <th>Sản phẩm</th>
                                        <th>Tổng tiền</th>
                                        <th>Trạng thái đơn hàng</th>
                                        <th class="text-center">Xem</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($orders as $order)

                                            <tr>
                                                <td>{{ $order->id }}</td>
                                                <td>{{ $order->created_at }}</td>
                                                <td>
                                                    @php $l = count($order->orderDetail) @endphp
                                                    @for($i=1; $i<=$l; $i++)
                                                        @if($i != 1) {!! ',' !!} @endif
                                                        {!! $order->orderDetail[$i-1]->product_name !!}
                                                        <b> x{!! $order->orderDetail[$i-1]->quantity !!}</b>
                                                    @endfor
                                                </td>
                                                <td>{{ $order->total_price }}</td>
                                                <td>{{ $order->pay_sta_name }}</td>
                                                <td class="text-center link-item-order"><a href="{{route('user.orderShow',$order->id)}}"><i class="fas fa-eye"></i></a></td>
                                            </tr>

                                    @endforeach
                                    </tbody>
                                </table>
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
        function validate(){
            let flag = true;
            let num = $('#phone').val();
            let phone = $("#validate-phone");
            let passwd = $('#new_password');
            let editPw = $('#editPasswd');
            if (isNaN(num) || num.length < 10) {
                phone.text("Số điện thoại nhập không chính sác. Vui lòng nhập lại.");
                flag = false;
            }
            if (editPw.is(':checked')){
                if (passwd.val().length < 6 || passwd.val().length > 32){
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
