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
                                <h1 class="title mb-4">Thông tin tài khoản</h1>
                            <div class="profile-content">
                                <form action="{{route('user.update')}}" method="POST" onsubmit="return validate()">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group">
                                        <label for="name">Họ và tên:</label>
                                        <input type="text" class="form-control" id="name"
                                               placeholder="vd: Đinh Công Thành" name="name" value="{{$user->name}}" required>
                                        <div class="invalid-feedback">Vui lòng nhập trường này.</div>
                                    </div>
                                    <div class="form-group">
                                        <label for="phone">Số điện thoại:</label>
                                        <input type="text" class="form-control" id="phone" placeholder="vd: 0909090909"
                                               name="phone"  value="{{$user->phone}}">
                                        <div class="text-danger my-2 validate" id="validate-phone"></div>
                                        <div class="invalid-feedback">Vui lòng nhập trường này.</div>
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email:</label>
                                        <input type="email" class="form-control" id="email"
                                               placeholder="vd: email@example.com" name="email" value="{{$user->email}}" readonly>
                                        <div class="invalid-feedback">Vui lòng nhập trường này.</div>
                                    </div>
{{--                                    <div class="gender">--}}
{{--                                        <p class="label"> Giới tính: </p>--}}
{{--                                        <div class="custom-control custom-radio custom-control-inline gender-radio">--}}
{{--                                            <input type="radio" class="custom-control-input" id="gender_male"--}}
{{--                                                   name="gender" value="1">--}}
{{--                                            <label class="custom-control-label" for="gender_male">Nam</label>--}}
{{--                                        </div>--}}
{{--                                        <div class="custom-control custom-radio custom-control-inline gender-radio">--}}
{{--                                            <input type="radio" class="custom-control-input" id="gender_female"--}}
{{--                                                   name="gender" value="0">--}}
{{--                                            <label class="custom-control-label" for="gender_female">Nữ</label>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <div class="form-group">--}}
{{--                                        <label for="date">Ngày sinh:</label>--}}
{{--                                        <input type="date" class="form-control" id="birth-day"--}}
{{--                                               placeholder="" name="birth_day">--}}
{{--                                    </div>--}}
                                    <div class="note text-center text-info">
                                        (Tùy chọn thêm)
                                    </div>
                                    <div class="form-group custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="editPasswd"
                                               name="editPasswd">
                                        <label class="custom-control-label" for="editPasswd">Đổi mật khẩu</label>
                                    </div>

                                    <div class="password-group">
                                        <div class="form-group">
                                            <label class="control-label" for="old_password">Mật khẩu cũ</label>
                                            <input type="password" name="old_password" class="form-control"
                                                   id="old_password" value="" autocomplete="off"
                                                   placeholder="Nhập mật khẩu cũ">

                                        </div>

                                        <div class="form-group">
                                            <label class="control-label" for="new-password">Mật khẩu mới</label>
                                            <input type="password" name="new_password" class="form-control"
                                                       id="new_password" value="" autocomplete="off"
                                                       placeholder="Mật khẩu từ 6 đến 32 ký tự">
                                            <span class="validate-pass text-danger"></span>
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label" for="re_new_password">Nhập lại</label>
                                            <input type="password" name="re_new_password" class="form-control"
                                                       id="re_new_password" value="" autocomplete="off"
                                                       placeholder="Nhập lại mật khẩu mới">
                                        </div>

                                    </div>
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-warning btn-submit">Cập nhật</button>
                                    </div>

                                </form>
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
