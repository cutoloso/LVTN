$(document).ready(function () {
    //loading
    $('#loading').css('display','none');
    //home page

    $('.slider-content').owlCarousel({
        loop: true,
        margin: 0,
        nav: true,
        navText: [
            "<i class='fas fa-angle-left'></i>",
            "<i class='fas fa-angle-right'></i>"
        ],
        autoplay: false,
        autoplayHoverPause: true,
        items: 1
    });

    $('.list-product').owlCarousel({
        loop: false,
        margin: 0,
        nav: true,
        dots: false,
        navText: [
            "<i class='fas fa-angle-left'></i>",
            "<i class='fas fa-angle-right'></i>"
        ],
        autoplay: false,
        autoplayHoverPause: true,
        responsive: {
            0: {
                items: 1,
            },
            424: {
                items: 2,
            },
            767: {
                items: 3,
            },
            991: {
                items: 4,
            },
            1199: {
                items: 5,
            }
        }
    });

    $('.brand-content').owlCarousel({
        loop: true,
        margin: 0,
        nav: false,
        dots: false,
        navText: [
            "<i class='fas fa-angle-left'></i>",
            "<i class='fas fa-angle-right'></i>"
        ],
        autoplay: true,
        autoplayHoverPause: true,
        responsive: {
            0: {
                items: 1,
            },
            480: {
                items: 2,
            },
            768: {
                items: 3,
            },
            992: {
                items: 4,
            },
            1200: {
                items: 5,
            }
        }
    });

    $('.news-list').owlCarousel({
        loop: true,
        margin: 0,
        nav: false,
        dots: false,
        navText: [
            "<i class='fas fa-angle-left'></i>",
            "<i class='fas fa-angle-right'></i>"
        ],
        autoplay: false,
        autoplayHoverPause: true,
        responsive: {
            0: {
                items: 1,
            },
            991: {
                items: 2,
            }
        }

    });

    window.onscroll = function () {
        StickyFunction()
    };

    let navbar = document.getElementById("header3");
    let sticky = navbar.offsetTop;

    function StickyFunction() {
        if ( $( window ).width() > 575){
            if (window.pageYOffset >= sticky) {
                $('#backtotop').addClass('show');
            } else {
                $("#backtotop").removeClass("show");
            }
        }
    }
    // Button cart
    $('.cart-wrapper').click(function () {
        $('.mini-cart-content').toggleClass('show-mini-cart');
    });

    // Croll to top
    $('.backtotop').on('click', function (event) {
        event.preventDefault();
        $('body,html').animate({
                scrollTop: 0,
            }, 700
        );
    });



    var background_thumb = $("div.image-zoom:last div.thumbnail").css('background-image');
    $("div.image-zoom")
        .mouseenter(function (e) {
            $("div.image-zoom:last div.thumbnail").css('background-image', 'none')
        })
        .mouseleave(function () {
            $("div.image-zoom:last div.thumbnail").css('background-image', background_thumb);
        });

    $('.product-outer .owl-stage-outer').mouseenter(function () {
        $(this).css('padding', '0 0 150px 0');
        $(this).css('margin', '0 0 -150px 0');
    });

    // Menu mobile
    $('.menu-mb-icon').click(function () {
        $('#header').toggleClass('act-menu');
    });

    // $('#compare-main .design-tag').click(function () {
    //     //     $('#compare-main .design-tag').removeClass('active');
    //     //     $(this).addClass('active');
    //     // });

    //single page

    // $('.xzoom5, .xzoom-gallery5').xzoom({tint: '#006699', Xoffset: 15});
    // $('.xzoom3, .xzoom-gallery3').xzoom({position: 'lens', lensShape: 'circle', sourceClass: 'xzoom-hidden'});
    $('.xzoom3, .xzoom-gallery3').xzoom({position: 'lens', lensShape: 'circle', bg:true, sourceClass: 'xzoom-hidden'});


// hide/show box edit info ship on shipping
    $('#shipping .shipping-edit-address').hide();
    $('#shipping .js-edit-address').on('click', function () {
        let p = $(this).parents('.shipping-details');
        p.children('.shipping-edit-address').slideDown();
    });
    $('#shipping .js-shipping-edit-hide').on('click', function(){
        $(this).parents('.shipping-edit-address').slideUp();
    });

    $('.js-choice-star').click(function () {
        let value = $(this).data('value');
        let select = $('.js-choice-star');
        select.removeClass('active');
        for (i=0; i<value; i++){
            select[i].classList.add("active");
        }
        $('#rating-star').val(value);
    });


});
