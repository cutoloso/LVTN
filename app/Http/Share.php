<?php

use GuzzleHttp\Client;

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

function countReviewStar($star, $pro_id)
{
    return DB::table('reviews')->where('pro_id',$pro_id)->where('star',$star)->count();
}

function percentReview($star, $totalReview){
    if ($totalReview == 0) return 0;
    return round(($star/$totalReview)*100,1);
}

function getAvgStar($pro_id){
    $avgStar = DB::table('reviews')->where('pro_id',$pro_id)->where('parent',0)->avg('star');
    return $avgStar;
}
function getTotalReview($pro_id){
    $totalReview = DB::table('reviews')->where('pro_id',$pro_id)->where('parent',0)->count();
    return $totalReview;
}

function getCurrency($vnd){
    $client = new Client();
    $query = ['access_key' => '73e15a1352267d4632fe4c7d7bfd9b7a','currencies' => 'VND','format' => '1'];
    $res = $client->request('GET', 'http://www.apilayer.net/api/live', [
        'query' => $query,
    ]);
    $status = $res->getStatusCode();
// "200"
    $response =  $res->getBody();
// {"type":"User"...'
    $data = json_decode($response);

    $usd_vnd = (float)$data->quotes->USDVND;
    return ($status)? round($vnd/$usd_vnd,2):false;
}

