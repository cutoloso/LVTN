@extends('layouts.master')
@section('header.title','Danh mục')
@section('header.css')

@endsection

@section('body.content')
<section id="filter-main">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="filter-brands">
                    @foreach($brands as $brand)
                        <a class="link-brand" href="javascript:" data-href="{{route('filter',['bra_id' => $brand->id])}}" data-bra="{{$brand->id}}" id="brand-{!! $brand->id !!}" class="brand">
                            <img src="{{env('ADMIN_URL')}}/storage/brands/{{$brand->img}}" alt="{{$brand->name}}">
                        </a>
                    @endforeach
                </div>
                <ul class="filter-price">
                    <li class="title">Chọn mức giá:</li>
                    <li class="frange">
                        <span class="link-price" id="min-0" data-min="0" data-max="2000000" >Dưới 2 triệu</span>
                        <span class="link-price" id="min-2000000" data-min="2000000" data-max="4000000" >Từ 2-4 triệu</span>
                        <span class="link-price" id="min-4000000" data-min="4000000" data-max="7000000" >Từ 4-7 triệu</span>
                        <span class="link-price" id="min-7000000" data-min="7000000" data-max="99999999" >Trên 7 triệu</span>
                        <a class="reset btn btn-danger btn-sm" href="{{route('filter')}}">
                            <span>Reset bộ lọc</span>
                            <i class="fas fa-times"></i>
                        </a>
                    </li>
                    <li class="sort">
                        <div class="dropdown">
                            <button type="button" class="btn border-secondary dropdown-toggle" data-toggle="dropdown">
                                Sắp xếp
                            </button>
                            <div class="dropdown-menu">
                                <a id="sort-asc" class="sort-item dropdown-item" href="javascript:" data-sort="asc" >Giá thấp đến cao</a>
                                <a id="sort-desc" class="sort-item dropdown-item" href="javascript:" data-sort="desc">Giá cao đến thấp</a>
                            </div>
                        </div>
                    </li>
                </ul>
                <div class="choosedfilter">
                    <div class="watching">
                        Điện thoại
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section id="category-main">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="cat-row">
                    @foreach($products as $product)
                        <div class="cat-col">
                            <div class="product-item">
                                <div class="product-inner">
                                    <div class="product-thumb">
                                        <div class="thumb-inner">
                                            <a class="thumb-link" href="{{route('get-single',$product->id)}}">
                                                <div class="img">
                                                    <img src="{{env('ADMIN_URL')}}/storage/products/{{$product->img}}" alt="">
                                                </div>
                                            </a>
                                        </div>
                                        <div class="group-button-mobile">
                                            <a href="javascript:" data-id="{{$product->id}}" class="add-cart"><i class="fas fa-cart-plus"></i></a>
                                            <a href="javascript:" data-id="{{$product->id}}" class="btn-compare">
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
                                        <a href="">
                                            <div class="product-name">
                                                {{$product->name}}
                                            </div>
                                        </a>

                                        <div class="product-price">
                                            @if($product->price_sale =='')
                                                @php echo number_format($product->price,0 ,'.' ,'.').'₫'; @endphp
                                            @else
                                                @php echo number_format($product->price_sale,0 ,'.' ,'.').'₫'; @endphp
                                            @endif
                                        </div>
                                        <div class="group-button">
                                            <div class="inner">
                                                <a href="javascript:" data-id="{{$product->id}}" class="add-cart">Thêm vào giỏ</a>
                                                <a href="javascript:" data-id="{{$product->id}}" class="btn-compare">
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
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="col-12 pagination-wrapper d-flex justify-content-center"> {{ $products->links() }}</div>
        </div>
    </div>
</section>

@endsection

@section('js')
    <script>




    </script>
    <script async type="text/javascript" >
        $(document).ready(function () {
            let jsonBrands = {!! json_encode($brands) !!};
            let urlParams = new URLSearchParams(location.search);
            let linkBrand = $('.link-brand');
            let linkPrice = $('.link-price');
            let titleFilter = 'Điện thoại';
            if (urlParams.has('bra_id') || urlParams.has('bra_id')){
                if (urlParams.has('bra_id')){
                    linkBrand.removeClass('active');
                    let brandId = parseInt(urlParams.get('bra_id'));
                    $('#brand-'+brandId).addClass('active');

                    let bra_name = '';
                    let l = jsonBrands.length;
                    for (let i=0;i<l;i++){
                        if(jsonBrands[i].id === brandId){
                            titleFilter += ' <span>'+jsonBrands[i].name+'</span>';
                            break;
                        }
                        console.log('ok');
                    }
                }
                if (urlParams.has('min_price')){
                    linkPrice.removeClass('active');
                    let e = $('#min-'+urlParams.get('min_price'))
                        .addClass('active');
                    titleFilter += ' <span>'+e.text()+'</span>'
                }
                if (urlParams.has('sort')){
                    $('.sort-item').removeClass('active');
                    let sort = $('#sort-'+urlParams.get('sort'))
                        .addClass('active');
                }
                $('.reset').show();
            }
            else {
                $('.reset').hide();
            }

            $('.watching').html(titleFilter);
            linkBrand.click(function () {
                if($(this).hasClass('active')){
                    let a=window.location.href;
                    let t='?bra_id='+urlParams.get('bra_id');
                    let s=a.replace(t, '');
                    location.replace(s);
                }
                else {
                    location.replace($(this).data('href'));
                }
            });

            linkPrice.click(function () {
                let a=window.location.href;
                let min=urlParams.get('min_price');
                let max=urlParams.get('max_price');
                let t="min_price="+min+"&max_price="+max;
                let b = "";
                let s ="";
                if($(this).hasClass('active')){
                    if(a.indexOf('category') > -1)
                    {
                        t="&min_price="+min+"&max_price="+max;
                    }
                    s = a.replace(t, '');

                }
                else{
                    if(a.indexOf('category') > -1)
                    {
                        t="&min_price="+min+"&max_price="+max;
                    }
                    s = a.replace(t, '');
                    b="?min_price="+$(this).data('min')+"&max_price="+$(this).data('max');
                    if(a.indexOf('?') > -1){
                        b="&min_price="+$(this).data('min')+"&max_price="+$(this).data('max');
                    }
                }

                location.replace(s+b);
            });

            $('.sort a').click(function () {
                let a=window.location.href;
                let o=urlParams.get('sort');
                let t="sort="+o;
                if(a.indexOf('&sort') > -1){
                    t="&sort="+o;
                }
                if(a.indexOf('?sort') > -1){
                    t="?sort="+o;
                }
                let s = a.replace(t, '');
                let b="?sort="+$(this).data('sort');
                if(a.indexOf('?') > -1){
                    b="&sort="+$(this).data('sort');
                    if(a.indexOf('?sort') > -1){
                        b="?sort="+$(this).data('sort');
                    }
                }
                location.replace(s+b);
            });
            $('.add-cart').click(function () {
                let htmlString = $( this ).html();
                $(this).html('<div class="ajax-loading"></div>');

                let id = $(this).data('id');
                $.ajax({
                    method: "GET",
                    url: 'add-to-cart/'+id,
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
        });
    </script>
@endsection
