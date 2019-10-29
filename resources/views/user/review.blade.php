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
                            <h1 class="title mb-4">Nhận xét của tôi</h1>
                            <div class="review-list">
                                @foreach($reviews as $review)
                                    <div class="review-item row">
                                        <div class="thumb col-2">
                                            <a href="{{route('get-single',$review->pro_id)}}">
                                                <img src="{{env('ADMIN_URL')}}/storage/products/{{$review->pro_details->img}}" alt="{{$review->pro_details->name}}">
                                            </a>
                                        </div>
                                        <div class="content col-10">
                                            <p class="pro-name">
                                                <a href="{{route('get-single',$review->pro_id)}}">{{$review->pro_details->name}}</a>
                                            </p>
                                            <p class="review-date">
                                                {{$review->created_at}}
                                            </p>
                                            <p>
                                                <span class="review-title">{{$review->title}}</span>
                                                <span class="star-rating">
                                                    <span class="star" style="width: {{($review->star)*10}}%"></span>
                                                </span>
                                            </p>

                                            <div class="review-content">
                                                {{$review->content}}
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="pagination-wrapper d-flex justify-content-center">{{ $reviews->links() }}</div>
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
