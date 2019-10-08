<!doctype html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="author" content="Cong Thanh">
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('favicon-96x96.png')}}">
    <title>AZmobile | @yield('header.title')</title>

    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/font-web.css')}}">
    <link rel="stylesheet" href="{{asset('css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/owl.theme.default.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/all.css')}}">
    <link rel="stylesheet" href="{{asset('css/xzoom.css')}}">
    <link rel="stylesheet" href="{{asset('css/fotorama.css')}}">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <link rel="stylesheet" href="{{asset('css/responsive.css')}}">
    <!-- Custom css -->
    @yield('header.css')
    <!-- End custom css -->
</head>
<body>
<div id="header-mobile">
    <div class="container">
        <div class="row menu-mb-col">
            <div class="menu-mb-icon">
                <i class="fas fa-bars"></i>
            </div>
            <div class="menu-mb-logo">
                <a href="{{env('APP_URL')}}">
                    <img alt="TechOne" src="{{asset('images/logo.png')}}">
                </a>
            </div>
            <div class="menu-mb-login">
                <a href="{{ route('login') }}">
                    <i class="fa fa-user-circle"></i>
                </a>
            </div>
            <div class="menu-mb-compare">
                <div class="compare">
                    <i class="fas fa-exchange-alt"></i>
                    <span class="compare-count">(0)</span>
                </div>
            </div>
            <div class="menu-mb-cart">
                <a href="{{route('get-cart')}}" class="cart">
                    <span class="icon">
                        <i class="fas fa-shopping-cart"></i>
                        <span class="count">1</span>
                    </span>
                </a>
            </div>
        </div>
    </div>
</div>
<div class="fix-mobile" style="width: 100%;"></div>
<section id="header">
    <div class="header1">
        <div class="container">
            <div class="row header1-content">
                <ul class="left">
                    <li><a class="active" href="{{env('APP_URL')}}">Home</a></li>
                    <li><a href="#">About us</a></li>
                    <li><a href="#">Contact us</a></li>
                </ul>
                <ul class="right">
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </div>
    <div class="header2">
        <div class="container">
            <div class="row header2-content">
                <div class="col-12 col-xl-2 text-center">
                    <div class="logo">
                        <a href="{{env('APP_URL')}}">
                            <img alt="TechOne" src="{{asset('images/logo.png')}}">
                        </a>
                    </div>
                </div>
                <div class="col-12 col-lg-6 col-xl-5 mid">
                    <form class="form-search" action="">
                        <input class="input-search" type="text" placeholder="Search...">
                        <button class="btn">
                            <i class="fas fa-search"></i>
                        </button>
                        <ul class="data-search">

                        </ul>
                    </form>

                </div>
                <div class="col-12 col-lg-6 col-xl-5">
                    <div class="header2-control">
                        <a class="compare" href="javascript:">
                            <span class="icon">
                                <i class="fas fa-exchange-alt"></i>
                            </span>
                            <span class="content">
                                <span class="text">So sánh &nbsp;</span><span class="compare-count">(0)</span>
                            </span>
                        </a>
                        <div class="cart-wrapper">
                            <a href="{{route('get-cart')}}" class="cart">
                                <span class="icon">
                                    <i class="fas fa-shopping-cart"></i>
                                    <span class="count">@php echo getCountCart(); @endphp</span>
                                </span>
                                @if(getCountCart()>0)
                                    <div class="content">
                                        <span class="text">cart</span>
                                        <span class="amount"><?php echo priceToString(getTotalPrice())?> ₫</span>
                                    </div>
                                @endif
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="header3" class="header3">
        <div class="container">
            <div class="row">
                <div class="col-12 header3-wrapper">
                    <ul class="header3-menu">
                        @php
                            $menus = getMemu();
                        @endphp
                        @foreach ($menus as $item)
                            <li>
                                <a href="{!! $item->link !!}">
                                    {!! $item->icon !!}
                                    <span>{{$item->name}}</span>
                                </a>
                            </li>
                        @endforeach

                        <li class="header3-form">
                            <form class="form-search"  action="">
                                <input class="input-search" type="text" placeholder="Bạn tìm gì...">
                                <button class="btn"><i class="fas fa-search"></i></button>
                                <ul class="data-search">

                                </ul>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Body content -->
@yield('body.content')

<!-- End body content -->
<div id="backtotop" class="backtotop show">
    <i class="fas fa-chevron-up"></i>
</div>
<section id="footer">
    <div class="container">
        <div class="row footer-top">
            <div class="col-6 col-md-6 col-lg-3">
                <div class="footer-col">
                    <div class="title">
                        Thông tin liên lạc
                    </div>
                    <ul class="content">
                        <li>218 Fifth Avenue, HeavenTower
                            NewYork City
                        </li>
                        <li>(+68) 123 456 7890</li>


                    </ul>
                    <div class="form-subcribe">
                        <div class="title-form">Đăng ký để nhận tin tức về sản phẩm và khuyến mãi</div>
                        <form action="">
                            <input type="text" placeholder="Email">
                            <a href="#" class="btn btn-subscribe">Đăng ký</a>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-5 offset-md-1 col-lg-3 offset-lg-0">
                <div class="footer-col">
                    <div class="title">
                        Thông tin
                    </div>
                    <ul class="content">
                        <li><a href="#">Giới thiệu công ty</a></li>
                        <li><a href="#">Tuyển dụng</a></li>
                        <li><a href="#">Gửi góp ý, khiếu nại</a></li>
                        <li><a href="#">Xem vị trí cửa hàng</a></li>
                        <li><a href="#">Trợ giúp</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-6 col-md-6 col-lg-3">
                <div class="footer-col">
                    <div class="title">
                        Hỗ trợ tư vấn
                    </div>
                    <ul class="content">
                        <li>Hỗ trợ kỹ thuật: <span>1800.1060 (7:30 - 22:00)</span></li>
                        <li>Hỗ trợ tư vấn: <span> 1800.1062 (8:00 - 21:30)</span></li>
                        <li>Gọi bảo hành: <span>1800.1064 (8:00 - 21:00)</span></li>

                    </ul>
                </div>
            </div>
            <div class="col-6 col-md-5 offset-md-1 col-lg-3 offset-lg-0">
                <div class="footer-col">
                    <div class="title">
                        Hỗ trợ tư vấn
                    </div>
                    <ul class="content">
                        <li>Hỗ trợ khách hàng: <span>Support@techone.com</span></li>
                        <li>Báo lỗi bảo mật: <span>security@techone.vn</span></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 footer-bottom">
                <div class="footer-bottom-copyright">
                    © Copyright TechOne. All Rights Reserved.
                </div>
                <div class="footer-bottom-social">
                    <a href="#">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="#">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="#">
                        <i class="fab fa-google-plus-g"></i>
                    </a>
                </div>
                <div class="footer-bottom-brand">
                    <img src="{{asset('images/visa.svg')}}" alt="">
                    <img src="{{asset('images/mastercard.svg')}}" alt="">
                    <img src="{{asset('images/american.png')}}" alt="">
                    <img src="{{asset('images/jcb.svg')}}" alt="">
                </div>
            </div>
        </div>
    </div>
</section>
<div id="loading">

</div>

</body>
</html>

<!--bootstrap-->
<script src="{{asset('js/jquery.min.js')}}"></script>
<script src="{{asset('js/popper.min.js')}}"></script>
<script src="{{asset('js/bootstrap.min.js')}}"></script>

<script src="{{asset('js/owl.carousel.min.js')}}"></script>
<script src="{{asset('js/xzoom.min.js')}}"></script>
<script src="{{asset('js/fotorama.js')}}"></script>
<script src="{{asset('js/myJs.js')}}"></script>
<!-- Custom js -->
@yield('js')
<script>
    $(document).ready(function () {
        if (sessionStorage.key('compare')){
            let compare = JSON.parse(sessionStorage.getItem('compare'));
            if(compare.pro1 || compare.pro2){
                $('.compare .compare-count').text('(2)');
            }
            else {
                $('.compare .compare-count').text('(2)');
            }
        }
        $('.compare').click(function () {
            let compare = JSON.parse(sessionStorage.getItem('compare'));
            console.log('{{env('APP_URL')}}/compare/'+compare.pro1+'-vs-'+compare.pro2);
            window.location.href = '{{env('APP_URL')}}/compare/'+compare.pro1+'-vs-'+compare.pro2;
        });
        $('.btn-compare').click(function () {
            $(this).html('<div class="ajax-loading"></div>');
            let compareCount = $('.compare .compare-count');
            if(compareCount.hasClass('heartBeat')){
                compareCount.removeClass('heartBeat')
            }
            let productId = $(this).data('id');
            // Khởi tạo sesionStorage
            if (!sessionStorage.key('compare')){
                let objProduct = {"pro1": productId};
                sessionStorage.setItem('compare', JSON.stringify(objProduct));
                compareCount.text('(1)');
            }
            else{
                objProduct = JSON.parse(sessionStorage.getItem('compare'));
                objProduct.pro2 = productId;
                sessionStorage.setItem('compare', JSON.stringify(objProduct));
                compareCount.text('(2)');
            }
            setTimeout(function(){
                $('.btn-compare').html('<i class="fas fa-exchange-alt"></i>');
                $('body,html').animate({
                        scrollTop: 0,
                    }, 500
                );
                compareCount.addClass('heartBeat');
            },500);
        });

        $('.input-search').keyup(function () {
            let keySearch = $(this).val();
            console.log(keySearch);

            if (keySearch !==''){
                $.ajax({
                    url: '{{route('search')}}',
                    method: 'POST',
                    dataType: "json",
                    data: {
                        _token: '{{csrf_token()}}',
                        key: keySearch
                    },
                    beforeSend: function () {

                    },
                    success: function (response) {
                        console.log(response);
                        let data = response.result;
                        var html = '';
                        data.forEach(function ($item) {
                            html +=
                                '<li><a href="/single/'+$item.id+'">' +
                                '<img src="'+'{{env("ADMIN_URL")}}/storage/products/'+$item.img+'">' +
                                '<h3>'+ $item.name +'</h3>' +
                                '<span class="price-sale">'+ $item.price_sale +'₫</span>' +
                                '<span class="price">'; if($item.price_sale !== $item.price)  html += $item.price; html += '</span>' +
                                '</a>' +
                                '</li>';
                        });
                        if (data.length !== 0){
                            $('.data-search').addClass('active').html(html);
                        }
                    }
                });
            }
            else {
                let dataSearch = $('.data-search');
                if(dataSearch.hasClass('active')) dataSearch.removeClass('active');
            }
        });

    });
</script>
<!-- End custom js -->
