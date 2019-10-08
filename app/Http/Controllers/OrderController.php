<?php

namespace App\Http\Controllers;

use App\OrderProduct, App\Order, Cart, DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $order = new Order();
        $order->sta_id = 1;
        $order->pay_sta_id = 1;
        $order->pay_mth_id = $request->pay_mth_id;
        $order->usr_id = Auth::user()->id;
        $order->name = $request->name;
        $order->address = $request->address;
        $order->phone = $request->phone;
        $order->save();
        $total_price = 0;
        $cartProducts = Cart::content();
        foreach ($cartProducts as $product){
            $orderProduct = new OrderProduct();
            $orderProduct->ord_id = $order->id;
            $orderProduct->pro_id = $product->id;
            $orderProduct->quantity = $product->qty;
            $orderProduct->price = $product->options->price_sale;
            $orderProduct->save();
            $total_price += $orderProduct->price;
        }
        $order->total_price = $total_price;
        $order->save();
        $orderProduct = DB::table('order_product')
            ->join('products','order_product.pro_id','=','products.id')
            ->where('ord_id', $order->id)
            ->select('order_product.*', 'products.name')
            ->get();
        $order = DB::table('orders')
            ->join('payment_method','orders.pay_mth_id','=','payment_method.id')
            ->where('orders.id', $order->id)
            ->select('orders.*', 'payment_method.name as pay_name')
            ->first();
        Cart::destroy();
        return view('shop.order-received',[
            'orderProduct'  => $orderProduct,
            'order'         => $order
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\OrderProduct  $orderProduct
     * @return \Illuminate\Http\Response
     */
    public function show(OrderProduct $orderProduct)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\OrderProduct  $orderProduct
     * @return \Illuminate\Http\Response
     */
    public function edit(OrderProduct $orderProduct)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\OrderProduct  $orderProduct
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, OrderProduct $orderProduct)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\OrderProduct  $orderProduct
     * @return \Illuminate\Http\Response
     */
    public function destroy(OrderProduct $orderProduct)
    {
        //
    }
}
