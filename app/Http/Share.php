<?php
function getMemu(){
    $menus = DB::table('menus')
        ->leftJoin('category','menus.cat_id','=','category.id')
        ->select('menus.sort','menus.link','category.*')
        ->orderBy('menus.sort')
        ->get();
    return $menus;
}
function getCountCart(){
    return Cart::count();
}
function getTotalPrice(){
    $carts = Cart::content();
    $total = 0;
    foreach ($carts as $cart){
        $total += $cart->options->price_sale*$cart->qty;
    }
    return $total;
}
function priceToString($price){
    $strPrice = [];
    $result = [];
    $strPrice = str_split($price);
    $count=1;
    $l = count($strPrice);
    for($i=$l-1; $i>=0; $i--){
        array_push($result, $strPrice[$i]);
        if($count%3==0) {
            array_push($result, ',');
        }
        $count++;
    }
    return implode(array_reverse($result));
}
function countReviewStar($star)
{
    return DB::table('reviews')->where('star',$star)->count();
}


