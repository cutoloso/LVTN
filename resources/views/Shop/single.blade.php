@extends('layouts.master')
@section('header.title','Trang giỏ hàng')
@section('header.css')

@endsection

@section('body.content')
    <?php //dd($cartProducts)?>

    <section id="single-product">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <ul class="breadcrumb">
                        <li>
                            <a href="{{env('APP_URL')}}">Trang chủ</a>
                            <span>›</span>
                        </li>
                        <li>
                            <a href="/category">Điện thoại</a>
                            <span>›</span>
                        </li>
                        <li class="active">
                            <span>{{$bra_name}}</span>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="row product-info">
                <div class="col-12">
                    <div class="product-title">
                        <div class="left">
                            <div class="product-name">
                                {{$product->name}}
                            </div>

                            <div class="star-rating">
                                <span class="star" style="width: {{$avgStar*20}}%"></span>
                            </div>
                            <span>{{$totalReview}} đánh giá</span>
                        </div>
                        <div class="fb-plugin">
                            <div class="fb-like"
                                 data-href="https://developers.facebook.com/docs/plugins/"
                                 data-width="" data-layout="button_count"
                                 data-action="like"
                                 data-size="small" data-show-faces="false"
                                 data-share="true">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-5 col-lg-5 product-image">
                    <div class="product-image">
                        <div class="xzoom-container">
                            <img class="xzoom3" id="xzoom-magnific"
                                 src="{{env('ADMIN_URL')}}/storage/products/{{$productImages[0]->img}}"
                                 xoriginal="{{env('ADMIN_URL')}}/storage/products/{{$productImages[0]->img}}"/>
                            <div class="xzoom-thumbs">
                                <a href="{{env('ADMIN_URL')}}/storage/products/{{$productImages[0]->img}}">
                                    <img class="xzoom-gallery3"
                                         src="{{env('ADMIN_URL')}}/storage/products/{{$productImages[0]->img}}"
                                         xpreview="{{env('ADMIN_URL')}}/storage/products/{{$productImages[0]->img}}"
                                         title="The description goes here">
                                </a>
                                @if(count($productImages)>1)
                                    <a href="{{env('ADMIN_URL')}}/storage/products/{{$productImages[1]->img}}">
                                        <img class="xzoom-gallery3"
                                             src="{{env('ADMIN_URL')}}/storage/products/{{$productImages[1]->img}}"
                                             title="The description goes here">
                                    </a>
                                    @if(count($productImages)>2)
                                        <button type="button" class="btn-viewall" data-toggle="modal"
                                                data-target="#viewall">
                                            <img class="img-viewall"
                                                 src="{{env('ADMIN_URL')}}/storage/products/{{$productImages[2]->img}}">
                                            <div class="img-count">
                                                Xem <br> hình
                                            </div>
                                        </button>
                                        <div class="modal fade" id="viewall">
                                            <div class="modal-dialog modal-lg modal-dialog-centered">
                                                <div class="modal-content">
                                                    <!-- Modal body -->
                                                    <!--Carousel Wrapper-->
                                                    <div class="fotorama"
                                                         data-max-width="100%"
                                                         data-nav="thumbs">>
                                                        @foreach($productImages as $productImage)
                                                            <img src="{{env('ADMIN_URL')}}/storage/products/{{$productImage->img}}">
                                                        @endforeach
                                                    </div>

                                                    <!--/.Carousel Wrapper-->
                                                </div>
                                            </div>
                                            <style>
                                                .fotorama__arr__arr {
                                                    background: url('{{env('APP_URL')}}/images/fotorama.png') no-repeat;
                                                }
                                            </style>
                                        </div>
                                    @endif
                                @endif

                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-12 col-md-7 col-lg-4 product-info">
                    <div class="summary-content">
                        <div class="price-wrapper">
                            <span class="price">
                                <?php echo number_format($product->price_sale,0 ,'.' ,'.')?>₫
                            </span>
                            @if($product->price_sale != '' && $product->price_sale != $product->price)
                                <del class="price-sale">
                                    <?php echo number_format($product->price,0 ,'.' ,'.')?>₫
                                </del>
                            @endif
                        </div>
                        <div class="product-stock">
                            <div class="stock in-stock">
                                <span class="label">Trạng thái: </span>Còn hàng
                            </div>
                        </div>
                        <div class="product-warranty">
                            <div class="warranty">
                                <span class="label">Bảo hành tới: </span>{{$product->warranty}} tháng <span>tại các cửa hàng toàn quốc</span>
                            </div>
                        </div>
                        <div class="discount">
                            <div class="title">KHUYẾN MÃI:</div>
                            <ul>
                                <li>
                                    <i class="fas fa-check-circle"></i>
                                    <span>Giảm thêm 5% (330.000₫) cho khách mua online có sinh nhật trong tháng 8</span>
                                    <a href="">Xem chi tiết</a>
                                </li>
                                <li>
                                    <i class="fas fa-check-circle"></i>
                                    <span>Cơ hội trúng 200 học bổng tổng trị giá đến 2 tỷ đồng. </span>
                                    <a href="">Xem chi tiết</a>
                                </li>
                            </ul>
                        </div>
                        <div class="btn-wrapper">
                            <a href="{{route('buy-now',$product->id)}}" class="buy-now btn">Mua ngay <br> <span>Giao hàng toàn quốc</span></a>
                            <a href="javascript:"  data-id="{{$product->id}}" class="add-cart add-cart-single btn">Thêm vào giỏ <br> <span>Ship COD</span></a>
                        </div>
                        <div class="callorder">
                            Gọi đặt mua: <a href="tel:1800xxxx">1800.xxxx</a> (miễn phí - 7:30-22:00)
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-3 product-accessories">
                    <ul class="policy">
                        <li>
                            <i class="fas fa-box-open"></i>
                            <span>Trong hộp có: Sạc, Tai nghe, Cáp, Cây lấy sim</span>
                        </li>
                        <li>
                            <i class="fas fa-award"></i>
                            <span>Bảo hành chính hãng 18 tháng.</span>
                        </li>
                        <li>
                            <i class="fas fa-undo"></i>
                            <span>Lỗi là đổi mới trong 1 tháng</span>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="row product-details">
                <div class="col-12">

                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#sumary">THÔNG TIN SẢN PHẨM</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#details">THÔNG SÔ KỸ THUẬT</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#review">ĐÁNH GIÁ</a>
                        </li>
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div id="sumary" class="container tab-pane active"><br>
                            {!! $product->description !!}
                        </div>
                        <div id="details" class="container tab-pane fade"><br>
                            <div class="row product-feature-title">
                                CẤU HÌNH SẢN PHẨM
                            </div>
                            @foreach($att_vals as $att_val)
                                <div class="row">
                                    <div class="col-6 feature-title">{{ $att_val->name }}:</div>
                                    <div class="col-6 feature-content">{{ $att_val->att_value }}</div>
                                </div>
                            @endforeach

                        </div>
                        <div id="review" class="container tab-pane fade"><br>
                            <div class="row review-summary" >
                                <div class="col-6 col-md-4 rv-col-left">
                                    <div class="title">
                                        Đánh giá trung bình
                                    </div>
                                    <div class="total-point">{{$avgStar}}/5</div>
                                    <div class="item-rating">
                                        <div class="star-rating">
                                            <span class="star" style="width: {{$avgStar*20}}%"></span>
                                        </div>
                                        <p class="comments-count">({{$totalReview}} nhận xét)</p>
                                    </div>
                                </div>
                                <div class="col-6 col-md-4 rv-col-mid">
                                    <div class="item rate-5">
                                        <span class="rating-num">5</span>
                                        <div class="progress">
                                            <div class="progress-bar bg-success" style="width: {!! percentReview((countReviewStar(5,(int)$product->id)),$totalReview) !!}%;">
                                            </div>
                                        </div>
                                        <span class="rating-num-total">{{ percentReview((countReviewStar(5,(int)$product->id)),$totalReview)}}%</span>
                                    </div>
                                    <div class="item rate-4">
                                        <span class="rating-num">4</span>
                                        <div class="progress">
                                            <div class="progress-bar bg-success" style="width: {!! percentReview((countReviewStar(4,(int)$product->id)),$totalReview) !!}%;">
                                            </div>
                                        </div>
                                        <span class="rating-num-total">{{ percentReview((countReviewStar(4,(int)$product->id)),$totalReview) }}%</span>
                                    </div>
                                    <div class="item rate-3">
                                        <span class="rating-num">3</span>
                                        <div class="progress">
                                            <div class="progress-bar bg-success" style="width: {!! percentReview((countReviewStar(3,(int)$product->id)),$totalReview) !!}%;">
                                            </div>
                                        </div>
                                        <span class="rating-num-total">{{ percentReview((countReviewStar(3,(int)$product->id)),$totalReview)}}%</span>
                                    </div>
                                    <div class="item rate-2">
                                        <span class="rating-num">2</span>
                                        <div class="progress">
                                            <div class="progress-bar bg-success" style="width: {!! percentReview((countReviewStar(2,(int)$product->id)),$totalReview) !!}%;">
                                            </div>
                                        </div>
                                        <span class="rating-num-total">{{ percentReview((countReviewStar(2,(int)$product->id)),$totalReview)}}%</span>
                                    </div>
                                    <div class="item rate-1">
                                        <span class="rating-num">1</span>
                                        <div class="progress">
                                            <div class="progress-bar bg-success" style="width: {!! percentReview((countReviewStar(1,(int)$product->id)),$totalReview) !!}%;">
                                            </div>
                                        </div>
                                        <span class="rating-num-total">{{ percentReview((countReviewStar(1,(int)$product->id)),$totalReview)}}%</span>
                                    </div>

                                </div>
                                @if (!Auth::check())
                                <div class="col-12 col-md-4 rv-col-right">
                                    <span>Chia sẻ nhận xét về sản phẩm</span>
                                    <button type="button" class="btn btn-default js-customer-button" data-toggle="modal"
                                            data-target="#modal-alert">Viết nhận xét của bạn
                                    </button>
                                </div>
                                @endif
                            </div>
                            @if ( Auth::check() && $checkCountReview == 0 )
                                <div class="row review-customer">
                                    <div class="col-12 title">
                                        Gửi nhận xét của bạn
                                    </div>
                                    <div class="col-12">
                                        <form action="{{route('review.store')}}" id="addReview" class="review-form" method="post">
                                            @csrf
                                            <div class="form-group">
                                                <label>1. Đánh giá của bạn về sản phẩm này:</label>
                                                <div class="rating-input">
                                                    <i class="fas fa-star js-choice-star active" data-value="1"></i>
                                                    <i class="fas fa-star js-choice-star" data-value="2"></i>
                                                    <i class="fas fa-star js-choice-star" data-value="3"></i>
                                                    <i class="fas fa-star js-choice-star" data-value="4"></i>
                                                    <i class="fas fa-star js-choice-star" data-value="5"></i>
                                                    <input type="number" hidden name="rating_star" id="rating-star"
                                                           data-clearable="xóa" class="js-rating-star hidden" data-min="1"
                                                           data-max="5" value="1">
                                                </div>
                                                <small class="help-block text-danger">Vui lòng chọn đánh giá của bạn về sản
                                                    phẩm này.</small>
                                            </div>
                                            <div class="form-group">
                                                <label for="review_title">2. Tiêu đề của nhận xét:</label>
                                                <input type="text" placeholder="Nhập tiêu đề nhận xét (không bắt buộc)"
                                                       name="title" id="review-title" class="form-control input-sm">
                                            </div>
                                            <div class="form-group">
                                                <label for="review_detail">3. Viết nhận xét của bạn vào bên dưới:</label>
                                                <textarea placeholder="Nhận xét của bạn về sản phẩm này"
                                                          class="form-control" name="detail" id="review-detail" cols="30"
                                                          rows="10" data-bv-field="detail" required></textarea>
                                                <small class="help-block text-danger review-detail-error">Nội dung chứa ít nhất 20 từ</small>
                                            </div>
                                            <input type="hidden" value="{{$product->id}}" name="pro_id" id="pro-id">
                                            <div class="action">
                                                <button type="button" class="btn btn-default btn-add-review js-add-review">Gửi nhận xét
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            @endif

                            <div class="row review-all">
                                <div class="col-12 review-filter">
                                    <span class="title">Chọn xem nhận xét</span>
{{--                                    <div class="btn-group dropdown">--}}
{{--                                        <button class="btn btn-default btn-sm dropdown-toggle" type="button"--}}
{{--                                                data-toggle="dropdown" aria-expanded="false">--}}
{{--                                            <span class="title">Mới nhất</span>--}}
{{--                                            <span class="caret"></span>--}}
{{--                                        </button>--}}
{{--                                        <ul id="sort-option1" class="sort-list dropdown-menu" role="menu">--}}
{{--                                            <li class="selected" data-parent-index="0" data-index="1">--}}
{{--                                                <a href="javascript:">Mới nhất</a>--}}
{{--                                            </li>--}}
{{--                                        </ul>--}}
{{--                                    </div>--}}
                                    <div class="btn-group dropdown">
                                        <button class="btn btn-default btn-sm dropdown-toggle" type="button"
                                                data-toggle="dropdown" aria-expanded="false">
                                            <span class="title">Tất cả sao</span>
                                            <span class="caret"></span>
                                        </button>
                                        <ul id="sort-list-star" class="sort-list dropdown-menu" role="menu">
                                            <li class="selected" data-star="-1">
                                                <a href="javascript:">Tất cả sao</a>
                                            </li>
                                            <li class="" data-star="5">
                                                <a href="javascript:">5 sao</a>
                                            </li>
                                            <li class="" data-star="4">
                                                <a href="javascript:">4 sao</a>
                                            </li>
                                            <li class="" data-star="3">
                                                <a href="javascript:">3 sao</a>
                                            </li>
                                            <li class="" data-star="2">
                                                <a href="javascript:">2 sao</a>
                                            </li>
                                            <li class="" data-star="1">
                                                <a href="javascript:">1 sao</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-12 review-list">
                                    @foreach($reviews as $review)
                                        <div class="review-item">
                                            <div class="reviewer-avatar">
                                                <div class="img">
                                                    <i class="fas fa-user-circle"></i>
                                                </div>
                                                <p class="name">{{$review->usr_name}}</p>
                                                <p class="date">{{$review->created_at}}</p>
                                            </div>
                                            <div class="reviewer-content">
                                                <div class="info">
                                                    <div class="star-rating">
                                                        <span class="star" style="width: {!! $review->star*20 !!}%"></span>
                                                    </div>
                                                    <span class="review-title">
                                                        @if($review->title)
                                                            {{$review->title}}
                                                        @endif
                                                    </span>
                                                    <div class="description">
                                                    <span>
                                                        {{$review->content}}
                                                    </span>
                                                    </div>
                                                    <div class="review-action">
                                                        <span class="show-quick-reply js-quick-reply">Gửi trả lời</span>
                                                    </div>
                                                    <div class="quick-reply" data-parent="{{$review->id}}">
                                                        <textarea class="form-control review-comment"
                                                              placeholder="Nhập nội dung trả lời tại đây. Tối đa 1500 từ"
                                                              id=""></textarea>
                                                        <span class="help-block text-left"></span>
                                                        <button type="button" class="btn btn-primary btn-add-comment js-add-comment"
                                                                data-review-id="2335646" >Gửi trả lời của bạn
                                                        </button>
                                                        <button type="button" class="btn btn-default js-quick-reply-hide">
                                                            Hủy bỏ
                                                        </button>
                                                    </div>
                                                    <div class="reply">
                                                        @foreach($review->subReview as $subReview)
                                                            <div class="reply-item">
                                                                <p class="reply-avatar">
                                                                    <i class="fas fa-user-circle"></i>
                                                                </p>
                                                                <p class="reply-name">{{$subReview->usr_name}}</p>
                                                                <p class="reply-content">
                                                                    <span>{{$subReview->content}}</span>
                                                                </p>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="col-12 pagination-wrapper d-flex justify-content-center">{{ $reviews->links() }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="product-related" class="product-outer">
        <div class="container  product-wrapper">
            <div class="row">
                <div class="col-12">
                    <div class="head">
                        <div class="title">
                            Sản phẩm liên quan
                        </div>

                    </div>
                </div>
            </div>
            <div class="row  product-wrapper">
                <div class="col-12">
                    <div class="list-product owl-carousel">
                        @foreach($relatedProducts as $relatedProduct)
                            @if($relatedProduct->id != $product->id)
                                <div class="product-item">
                                    <div class="product-inner">
                                        <div class="product-thumb">
                                            <div class="thumb-inner">
                                                <a class="thumb-link" href="{{route('get-single',$relatedProduct->id)}}">
                                                    <img src="{{env('ADMIN_URL')}}/storage/products/{{$relatedProduct->img}}" alt="">
                                                </a>
                                            </div>
                                            <div class="group-button-mobile">
                                                <a href="#" class="add-cart">Thêm vào giỏ</a>
                                                <a href="#" class="compare">
                                                    <i class="fas fa-exchange-alt"></i>
                                                </a>
                                                <a href="#" class="add_wishlist">
                                                    <i class="far fa-heart"></i>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="product-info">
                                            <div class="star-rating">
                                                <span class="star" style="width: {{getAvgStar($product->id)*20}}%"></span>({{getTotalReview($product->id)}})
                                            </div>
                                            <div class="product-name">
                                                <a href="">{{$relatedProduct->name}}</a>
                                            </div>
                                            <div class="product-price">
                                                <?php echo number_format($relatedProduct->price,0 ,'.' ,'.')?>
                                            </div>
                                            <div class="group-button">
                                                <div class="inner">
                                                    <a href="javascript:" data-id="{{$relatedProduct->id}}" class="add-cart">Thêm vào giỏ</a>
                                                    <a href="javascript:" data-id="{{$relatedProduct->id}}" class="btn-compare">
                                                        <i class="fas fa-exchange-alt"></i>
                                                    </a>
                                                    <a href="#" class="add_wishlist">
                                                        <i class="far fa-heart"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- The Modal Alert login-->
    <div class="modal" id="modal-alert">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Bạn cần login để sử dụng chức năng này.</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <form action="{{route('login')}}" method="GET">
                        <button type="submit" class="btn btn-primary" >OK</button>
                    </form>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                </div>

            </div>
        </div>
    </div>

    <!-- The modal Validate review -->
    <div class="modal" id="modal-review">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Vui lòng kiểm tra lại đánh giá của bạn. Nội dung và số sao đánh giá phải phù hợp</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">OK</button>
                </div>

            </div>
        </div>
    </div>
@endsection

@section('js')
{{--    <script src="{{asset('app/lib/angular.min.js')}}"></script>--}}
{{--    <script src="{{asset('app/app.js')}}"></script>--}}
{{--    <script src="{{asset('app/ReviewController.js')}}"></script>--}}
    <script>
        $(document).ready(function () {
            {{--$('.add-cart-single').click(function () {--}}
            {{--    let htmlString = $( this ).html();--}}
            {{--    let current = $(this);--}}
            {{--    current.html('<div class="ajax-loading"></div>');--}}

            {{--    let id = $(this).data('id');--}}
            {{--    $.ajax({--}}
            {{--        method: "POST",--}}
            {{--        url: '/add-to-cart/'+id,--}}
            {{--        data:{--}}
            {{--            _token : "{{ csrf_token() }}"--}}
            {{--        },--}}
            {{--        beforeSend: function () {--}}
            {{--            $('#header .header2 .header2-content .header2-control .icon .count').removeClass('heartBeat');--}}
            {{--        },--}}
            {{--        success: function (response) {--}}
            {{--            setTimeout(function(){--}}
            {{--                $('#header .header2 .header2-content .header2-control .icon .count').text(response.cartCount);--}}
            {{--                $('#header-mobile .menu-mb-col .menu-mb-cart .icon .count').text(response.cartCount);--}}

            {{--                if ($(window).width() > 575){--}}
            {{--                    current.html(htmlString);--}}
            {{--                }else{--}}
            {{--                    current.html('<i class="fas fa-cart-plus"></i>');--}}
            {{--                }--}}
            {{--                $('body,html').animate({--}}
            {{--                        scrollTop: 0,--}}
            {{--                    }, 500--}}
            {{--                );--}}
            {{--                $('#header .header2 .header2-content .header2-control .icon .count').addClass('heartBeat');--}}
            {{--                $('#header-mobile .menu-mb-col .menu-mb-cart .icon .count').addClass('heartBeat');--}}
            {{--            }, 500);--}}
            {{--        }--}}
            {{--    });--}}

            {{--});--}}
            //update reviews
            function updateReview(dataReviews) {
                let html = '';
                dataReviews.forEach(function (review) {
                    html +=
                        '<div class="review-item">'+
                        '<div class="reviewer-avatar">'+
                        '<div class="img">'+
                        '<i class="fas fa-user-circle"></i>'+
                        '</div>'+
                        '<p class="name">'+review.usr_name+'</p>'+
                        '<p class="date">'+review.created_at+'</p>'+
                        '</div>'+
                        '<div class="reviewer-content">'+
                        '<div class="info">'+
                        '<div class="star-rating">'+
                        '<span class="star" style="width: '+review.star*20+'%"></span>'+
                        '</div>'+
                        '<span class="review-title">'; if(review.title) html+=review.title; html+='</span>'+
                        '<div class="description">'+
                        '<span>'+review.content+'</span>'+
                        '</div>'+
                        '<div class="review-action">'+
                        '<span class="show-quick-reply js-quick-reply">Gửi trả lời</span>'+
                        '</div>'+
                        '<div class="quick-reply" data-parent="'+review.id+'">'+
                        '<textarea class="form-control review-comment"'+
                        ' placeholder="Nhập nội dung trả lời tại đây. Tối đa 1500 từ"'+
                        'id=""></textarea>'+
                        '<span class="help-block text-left"></span>'+
                        '<button type="button" class="btn btn-primary btn-add-comment js-add-comment"'+
                        'data-review-id="2335646">Gửi trả lời của bạn'+
                        ' </button>'+
                        '<button type="button" class="btn btn-default js-quick-reply-hide">Hủy bỏ</button>'+
                        '</div>'+
                        '<div class="reply">';
                    review.subReview.forEach(function (sub) {
                        html +=
                            '<div class="reply-item">'+
                            '<p class="reply-avatar">'+
                            '<i class="fas fa-user-circle"></i>'+
                            '</p>'+
                            '<p class="reply-name">'+sub.usr_name+'</p>'+
                            '<p class="reply-content">'+
                            '<span>'+sub.content+'</span>'+
                            '</p>'+
                            '</div>';
                    });
                    html +=
                        '</div>'+
                        '</div>'+
                        '</div>'+
                        '</div>';
                });
                return html;
            }

            // hide/show box reply on single-product
            function afterUpdateReviews(){
                $('#review .quick-reply').hide();
                $('#review .js-quick-reply').on('click', function () {
                    @if(!Auth::check())
                        $('#modal-alert').modal();
                    @else
                        let p = $(this).parents('.info');
                        p.children('.quick-reply').slideDown();
                    @endif
                });
                $('#review .js-quick-reply-hide').on('click', function(){
                    $(this).parent().slideUp();
                });

                $('.js-add-comment').click(function () {
                    let content = $(this).parents('.quick-reply');
                    let parent = content.data('parent');
                    console.log(parent);
                    let detail = content.children('.review-comment').val();
                    if (detail){
                        let pro_id = $('#pro-id').val();

                        $.ajax({
                            url: '{{route("review.store")}}',
                            method: 'POST',
                            dataType: "json",
                            data: {
                                _token: "{{csrf_token()}}",
                                pro_id: pro_id,
                                parent: parent,
                                star: 0,
                                title: '',
                                detail: detail,

                            },
                            beforeSend: function(data){
                                // console.log(data);
                            },
                            success: function (response) {
                                console.log(response);
                                let html = updateReview(response.reviews);
                                $('.review-list').html(html);
                                afterUpdateReviews();
                            }
                        });
                    }
                });
            }

            afterUpdateReviews();
            function addReview(pro_id, star, title, detail, sentiment){
                $.ajax({
                    url: '{{route("review.store")}}',
                    method: 'POST',
                    dataType: "json",
                    data: {
                        _token: "{{csrf_token()}}",
                        pro_id: pro_id,
                        parent: 0,
                        star: star,
                        title: title,
                        detail: detail,
                        sentiment: sentiment

                    },
                    beforeSend: function(data){
                        // console.log(data);
                    },
                    success: function (response) {
                        console.log(response);
                        let html = updateReview(response.reviews);
                        $('.review-list').html(html);
                        afterUpdateReviews();
                        console.log('added review');
                        $('.review-customer').hide();
                    }
                });
            }

            $('.js-add-review').click(function () {
                let reviewDetail = $('#review-detail');
                let lenReviewDetail = reviewDetail.val().split(" ").length;
                if ( lenReviewDetail > 0){
                    $('.review-detail-error').css('display','none');
                    let star = $('#rating-star').val();
                    let title = $('#review-title').val();
                    let detail = reviewDetail.val();
                    let pro_id = $('#pro-id').val();

                    $.ajax({
                        url : 'http://127.0.0.1:5000/sentiment',
                        method: 'POST',
                        data: {
                            'review' : detail
                        },
                        success: function (response) {
                            if (response.sentiment <= 0.5 && star <= 3 || response.sentiment > 0.5 && star > 3){
                                console.log('ok');
                                addReview(pro_id, star, title, detail, response.sentiment)
                            }
                            else {
                                // alert('senti: '+response.sentiment+' star: '+star);
                                $('#modal-review').modal('show');
                            }
                        },
                    });



                    {{--$.ajax({--}}
                    {{--    url: '{{route("review.store")}}',--}}
                    {{--    method: 'POST',--}}
                    {{--    dataType: "json",--}}
                    {{--    data: {--}}
                    {{--        _token: "{{csrf_token()}}",--}}
                    {{--        pro_id: pro_id,--}}
                    {{--        parent: 0,--}}
                    {{--        star: star,--}}
                    {{--        title: title,--}}
                    {{--        detail: detail,--}}

                    {{--    },--}}
                    {{--    beforeSend: function(data){--}}
                    {{--        // console.log(data);--}}
                    {{--    },--}}
                    {{--    success: function (response) {--}}
                    {{--        console.log(response);--}}
                    {{--        let html = updateReview(response.reviews);--}}
                    {{--        $('.review-list').html(html);--}}
                    {{--        afterUpdateReviews();--}}
                    {{--    }--}}
                    {{--});--}}
                }
                else {
                    $('.review-detail-error').css('display','block');
                }
            });

            $('#sort-list-star li').click(function () {
                let star = $(this).data('star');
                let pro_id = {{$product->id}};
                console.log(star);
                $.ajax({
                    url: '{{route("review.index")}}' +'-filter',
                    method: 'GET',
                    dataType: "json",
                    data: {
                        _token: "{{csrf_token()}}",
                        star: star,
                        pro_id: pro_id
                    },
                    beforeSend: function(data){
                        // console.log(data);
                    },
                    success: function (response) {
                        let html = updateReview(response.reviews);
                        $('.review-list').html(html);
                        afterUpdateReviews();
                    }
                });
            });

            {{--$('.pagination a').unbind('click').on('click', function(e) {--}}
            {{--    e.preventDefault();--}}
            {{--    var page = $(this).attr('href').split('page=')[1];--}}
            {{--    getPosts(page);--}}
            {{--});--}}
            {{--var origin = window.location.origin;--}}
            {{--function getPosts(page)--}}
            {{--{--}}
            {{--    let pro_id = {{$product->id}};--}}
            {{--    $.ajax({--}}
            {{--        type: "GET",--}}
            {{--        url: origin+'/api/review/'+pro_id+'?page='+ page,--}}
            {{--        success: function (response) {--}}
            {{--            let html = updateReview(response.reviews.data);--}}
            {{--            $('.review-list').html(html);--}}
            {{--            afterUpdateReviews();--}}
            {{--        }--}}
            {{--    })--}}
            {{--}--}}
        });
    </script>
@endsection
