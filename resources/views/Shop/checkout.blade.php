@extends('layouts.master')
@section('header.title','Địa chỉ giao hàng')
@section('header.css')

@endsection

@section('body.content')
    <section id="shipping">
        <div class="container">
            <div class="row">
                <div class="col-12 shipping-title">
                    Xác nhận địa chỉ giao hàng
                </div>
            </div>
            <div class="row">
                <div class="col-12 shipping-details">
                    <p>Chọn địa chỉ giao hàng có sẵn hoặc chỉnh sửa địa chỉ mặc định:</p>
                    <div class="shipping-box-info">
                        <div class="col-12 col-md-6">
                            <div class="left">
                                <p><span class="label">Họ và tên:</span>{{ $customer->name }}</p>
                                <p><span class="label">Địa chỉ: </span>{{ $customer->address }}</p>
                                <p><span class="label">Điện thoại: </span>{{ $customer->phone }}</p>
{{--                                <p><span class="label">Email: </span>{{ $customer->email }}</p>--}}
                                <p>
                                    <a class="btn btn-accept-address" href="{{route("get-payment","custom")}}">Giao đến địa chỉ này</a>
                                    <button class="btn btn-edit js-edit-address">Chỉnh sửa</button>
                                </p>
                            </div>
                        </div>
{{--                        <div class="col-12 col-md-6">--}}
{{--                            <div class="right">--}}
{{--                                <p><span class="label">Họ và tên:</span>{{ Auth::user()->name }}</p>--}}
{{--                                <p><span class="label">Địa chỉ: </span>{{ Auth::user()->address }}</p>--}}
{{--                                <p><span class="label">Điện thoại: </span>{{ Auth::user()->phone }}</p>--}}
{{--                                <p><span class="label">Email: </span>{{ Auth::user()->email }}</p>--}}
{{--                                <p>--}}
{{--                                    <a class="btn btn-accept-address" href="{{route("get-payment","default")}}">Giao đến địa chỉ này</a>--}}
{{--                                    <button class="btn btn-edit js-edit-address">Chỉnh sửa</button>--}}
{{--                                </p>--}}
{{--                                <span class="default">Mặc định</span>--}}
{{--                            </div>--}}
{{--                        </div>--}}
                    </div>
                    <div class="shipping-edit-address">
                        <form action="{{route('customer.update',Auth::user()->id)}}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="name">Họ & tên:</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ Auth::user()->name }}" required>
                            </div>
                            <div class="form-group">
                                <label >Điện thoại di động:</label>
                                <input type="text" class="form-control" id="phone" name="phone" value="{{ Auth::user()->phone }}" onblur="validate()" required>
                                <p class="text-danger" id="validate-phone"></p>
                            </div>
                            <div class="form-group">
                                <label>Tỉnh/Thành phố:</label>
                                <select class="form-control" id="region" name="region" required>

                                </select>
                            </div>
                            <div class="form-group">
                                <label >Quận/Huyện:</label>
                                <select class="form-control" id="city" name="city" required>
                                    <option value="">Chọn Quận/Huyện</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label >Phường/Xã:</label>
                                <select class="form-control" id="ward" name="ward" required>
                                    <option value="">Chọn Phường/Xã</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label >Địa chỉ:</label>
                                <input type="text" class="form-control" id="address" name="address" required>
                            </div>
                            <p>
                            <div class="btn btn-cancel js-shipping-edit-hide">Hủy bỏ</div>
                            <button type="submit" class="btn btn-update">Cập nhật</button>
                            </p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@section('js')
    <script>
        // Chỉ cho nhập số vào field số điện thoại
        function validate() {
            var num = $('#phone').val();
            if (isNaN(num) || num.length<10) {
                $("#validate-phone").text("Số điện thoại nhập không chính sác. Vui lòng nhập lại.");
            } else {
                $("#validate-phone").text('');
            }
        }
        $(document).ready(function () {


            // get regions
            $.ajax({
                url: '{{route('get-region')}}',
                type: 'GET',
                data: {
                    "_token": "{{ csrf_token() }}"
                },
                success: function (data) {
                    let html = '<option value="">Chọn Tỉnh/Thành phố</option>';
                    data.regions.forEach(function (region) {
                        html += '<option value="' + region.matp + '">' + region.name + '</option>';
                    });
                    $('#region').html(html);
                    // select_option('#bra-id',value);
                }
            });

            $('#region').change(function () {
                let matp = $(this).val();
                $.ajax({
                    url: 'get-city/'+matp,
                    type: 'GET',
                    data: {
                        "_token": "{{ csrf_token() }}"
                    },
                    success: function (data) {

                        let html = '<option value="">Chọn Quận/Huyện</option>';
                        data.cityes.forEach(function (city) {
                            html += '<option value="' + city.maqh + '">' + city.name + '</option>';
                        });
                        $('#city').html(html);
                        // select_option('#bra-id',value);
                    }
                });
            });
            $('#city').change(function () {
                let maqh = $(this).val();
                $.ajax({
                    url: 'get-ward/' + maqh,
                    type: 'GET',
                    data: {
                        "_token": "{{ csrf_token() }}"
                    },
                    success: function (data) {
                        let html = '<option value="">Chọn Phường/Xã</option>';
                        data.wards.forEach(function (ward) {
                            html += '<option value="' + ward.xaid + '">' + ward.name + '</option>';
                        });
                        $('#ward').html(html);
                        // select_option('#bra-id',value);
                    }
                });
            });

        });
    </script>
@endsection
