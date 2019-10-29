@extends('layouts.master')
@section('header.title')
    So Sánh {!! $product1->name !!} và {!! $product2->name !!}
    @endsection
@section('header.css')

@endsection
@section('body.content')
<!--    --><?php //dd($product1);?>
    <section id="compare-main">
        <div class="container">
            <div class="row">
                <div class="col-12 compare-title text-center">
                    So sánh điện thoại <span class="product-name">{!! $product1->name !!}</span> và <span class="product-name">{!! $product2->name !!}</span>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-sm-4"></div>
                <div class="col-6 col-sm-4 product-images-wrapper">
                    <a href="{{route('get-single',$product1->id)}}">
                        <div class="product-images">
                            @foreach($imagesPro1 as $imgPro1)
                                @if($imgPro1->active == 1)
                                    <img src="{{env('ADMIN_URL')}}/storage/products/{{$imgPro1->img}}" alt="{{$product1->name}}">
                                @endif
                            @endforeach
                        </div>
                        <div class="product-name">
                            {!! $product1->name !!}
                        </div>
                        <div class="product-price">
                            <?php echo number_format($product1->price_sale)?>₫
                        </div>
                    </a>
                    <div class="rating">
                        <div class="star-rating">
                            <span class="star" style="width: {!! $avgReview1*100 !!}%"></span>
                        </div>
                        <span>{{$totalReview1}} đánh giá</span>
                    </div>
                </div>
                <div class="col-6 col-sm-4 product-images-wrapper">
                    <a href="{{route('get-single',$product2->id)}}">
                        <div class="product-images">
                                @foreach($imagesPro2 as $imgPro2)
                                    @if($imgPro2->active == 1)
                                        <img src="{{env('ADMIN_URL')}}/storage/products/{{$imgPro2->img}}" alt="{{$product2->name}}">
                                    @endif
                                @endforeach
                        </div>
                        <div class="product-name">
                            {!! $product2->name !!}
                        </div>
                        <div class="product-price">
                            <?php echo number_format($product2->price_sale)?>₫
                        </div>
                    </a>
                    <div class="rating">
                        <div class="star-rating">
                            <span class="star" style="width: {!! $avgReview2*100 !!}%"></span>
                        </div>
                        <span>{{$totalReview2}} đánh giá</span>
                    </div>
                </div>
            </div>
            <div class="row product-feature-title">
                CẤU HÌNH SẢN PHẨM
            </div>
            @php $i=0; @endphp
            @foreach($product1->attribute as $att)
            <div class="row">
                <div class="col-12 col-sm-4 feature-title">{{$att->name}}:</div>
                <div class="col-6 col-sm-4 feature-content">{{$att->att_value}}</div>
                <div class="col-6 col-sm-4 feature-content">{{$product2->attribute[$i]->att_value}}</div>
            </div>
            @php $i++; @endphp
            @endforeach
            <div class="row product-feature-title">
                THIẾT KẾ SẢN PHẨM
            </div>
            <div class="row compare-design-img-row">
                <div class="col-12 col-sm-4 feature-title">Hình chụp</div>
                <!-- Tab panes -->
                <div class="tab-content col-12 col-sm-8">
                    <div id="front" class="tab-pane active">
                        <div class="row">
                            <div  class="col-6 design-img feature-content">
                                @foreach($imagesPro1 as $imgPro1)
                                    @if($imgPro1->front == 1)
                                        <img src="{{env('ADMIN_URL')}}/storage/products/{{$imgPro1->img}}" alt="{{$product1->name}}">
                                    @endif
                                @endforeach
                            </div>
                            <div  class="col-6 design-img feature-content">
                                @foreach($imagesPro2 as $imgPro2)
                                    @if($imgPro2->front == 1)
                                        <img src="{{env('ADMIN_URL')}}/storage/products/{{$imgPro2->img}}" alt="{{$product2->name}}">
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div id="back" class="tab-pane fade">
                        <div class="row">
                            <div  class="col-6 design-img feature-content">
                                @foreach($imagesPro1 as $imgPro1)
                                    @if($imgPro1->back == 1)
                                        <img src="{{env('ADMIN_URL')}}/storage/products/{{$imgPro1->img}}" alt="{{$product1->name}}">
                                    @endif
                                @endforeach
                            </div>
                            <div  class="col-6 design-img feature-content">
                                @foreach($imagesPro2 as $imgPro2)
                                    @if($imgPro2->back == 1)
                                        <img src="{{env('ADMIN_URL')}}/storage/products/{{$imgPro2->img}}" alt="{{$product2->name}}">
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div id="left" class="tab-pane fade">
                        <div class="row">
                            <div  class="col-6 design-img feature-content">
                                @foreach($imagesPro1 as $imgPro1)
                                    @if($imgPro1->left == 1)
                                        <img src="{{env('ADMIN_URL')}}/storage/products/{{$imgPro1->img}}" alt="{{$product1->name}}">
                                    @endif
                                @endforeach
                            </div>
                            <div  class="col-6 design-img feature-content">
                                @foreach($imagesPro2 as $imgPro2)
                                    @if($imgPro2->left == 1)
                                        <img src="{{env('ADMIN_URL')}}/storage/products/{{$imgPro2->img}}" alt="{{$product2->name}}">
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div id="right" class="tab-pane fade">
                        <div class="row">
                            <div  class="col-6 design-img feature-content">
                                @foreach($imagesPro1 as $imgPro1)
                                    @if($imgPro1->right == 1)
                                        <img src="{{env('ADMIN_URL')}}/storage/products/{{$imgPro1->img}}" alt="{{$product1->name}}">
                                    @endif
                                @endforeach
                            </div>
                            <div  class="col-6 design-img feature-content">
                                @foreach($imagesPro2 as $imgPro2)
                                    @if($imgPro2->right == 1)
                                        <img src="{{env('ADMIN_URL')}}/storage/products/{{$imgPro2->img}}" alt="{{$product2->name}}">
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div id="above" class="tab-pane fade">
                        <div class="row">
                            <div  class="col-6 design-img feature-content">
                                @foreach($imagesPro1 as $imgPro1)
                                    @if($imgPro1->above == 1)
                                        <img src="{{env('ADMIN_URL')}}/storage/products/{{$imgPro1->img}}" alt="{{$product1->name}}">
                                    @endif
                                @endforeach
                            </div>
                            <div  class="col-6 design-img feature-content">
                                @foreach($imagesPro2 as $imgPro2)
                                    @if($imgPro2->above == 1)
                                        <img src="{{env('ADMIN_URL')}}/storage/products/{{$imgPro2->img}}" alt="{{$product2->name}}">
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div id="below" class="tab-pane fade">
                        <div class="row">
                            <div  class="col-6 design-img feature-content">
                                @foreach($imagesPro1 as $imgPro1)
                                    @if($imgPro1->below == 1)
                                        <img src="{{env('ADMIN_URL')}}/storage/products/{{$imgPro1->img}}" alt="{{$product1->name}}">
                                    @endif
                                @endforeach
                            </div>
                            <div  class="col-6 design-img feature-content">
                                @foreach($imagesPro2 as $imgPro2)
                                    @if($imgPro2->below == 1)
                                        <img src="{{env('ADMIN_URL')}}/storage/products/{{$imgPro2->img}}" alt="{{$product2->name}}">
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 compare-design-wrapper">
                    <div class="row">
                        <div class="col-12 col-sm-8 offset-sm-4 compare-design-action">
                            <span class="compare-design-label">Đang xem hình</span>
                            <!-- Nav pills -->
                            <ul class="compare-design-tag nav" id="compare-design">
                                <li class="design-tag nav-item">
                                    <a href="#front" class="nav-link active" data-toggle="pill"><i class="rad"></i><span>Mặt trước</span></a>
                                </li>
                                <li class="design-tag nav-item">
                                    <a href="#back" class="nav-link" data-toggle="pill"><i class="rad"></i><span>Mặt sau</span></a>
                                </li>
                                <li class="design-tag nav-item">
                                    <a href="#left" class="nav-link" data-toggle="pill"><i class="rad"></i><span>Cạnh trái</span></a>
                                </li>
                                <li class="design-tag nav-item">
                                    <a href="#right" class="nav-link" data-toggle="pill"><i class="rad"></i><span>Cạnh phải</span></a>
                                </li>
                                <li class="design-tag nav-item">
                                    <a href="#above" class="nav-link" data-toggle="pill"><i class="rad"></i><span>Trên</span></a>
                                </li>
                                <li class="design-tag nav-item">
                                    <a href="#below" class="nav-link" data-toggle="pill"><i class="rad"></i><span>Dưới</span></a>
                                </li>
                            </ul>

                        </div>
                    </div>
                </div>

            </div>
            <div class="row product-feature-title">
                &nbsp;
            </div>
            <div class="row">
                <div class="col-12 col-sm-4 feature-title">&nbsp;</div>
                <div class="col-6 col-sm-4 feature-content">
                    <a class="add-cart btn" href="javascript:" data-id="{{$product1->id}}">Thêm vào giỏ ngay</a>
                </div>
                <div class="col-6 col-sm-4 feature-content">
                    <a class="add-cart btn" href="javascript:" data-id="{{$product2->id}}">Thêm vào giỏ ngay</a>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('js')
    <script>
        $(document).ready(function () {
            $('.add-cart').click(function () {
                let htmlString = $( this ).html();
                $(this).html('<div class="ajax-loading"></div>');

                let id = $(this).data('id');
                $.ajax({
                    method: "GET",
                    url: '/add-to-cart/'+id,
                    data:{
                        _token : "{{ csrf_token() }}"
                    },
                    beforeSend: function () {
                        $('#header .header2 .header2-content .header2-control .icon .count').removeClass('heartBeat');
                    },
                    success: function (response) {
                        setTimeout(function(){
                            $('#header .header2 .header2-content .header2-control .icon .count').text(response.cartCount);
                            $('.add-cart').html(htmlString);
                            $('body,html').animate({
                                    scrollTop: 0,
                                }, 500
                            );
                            $('#header .header2 .header2-content .header2-control .icon .count').addClass('heartBeat');
                        }, 500);
                    }
                });

            });

            // xóa tất cả item trong sessionStorage
            sessionStorage.clear();
        });
    </script>
@endsection
