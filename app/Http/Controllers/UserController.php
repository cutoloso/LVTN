<?php

namespace App\Http\Controllers;
use App\User;
use DB;
use Session;
use Illuminate\Support\Facades\Hash;
use DemeterChain\A;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index(){
        $id = Auth::user();
        return view('user.index', ['user']);
    }
    public function account(){
        $user = Auth::user();
        return view('user.index', ['user'=>$user]);
    }

    public function update(Request $request){
        $user = User::find(Auth::user()->id);
        if(isset($request->editPasswd) && isset($request->new_password)){
            if (Hash::check($request->old_password, $user->password))
            {
                $user->password = bcrypt($request->new_password);
            }
            else{
                Session::flash('false','Mật khẩu cũ sai, vui lòng nhập lại');
                return redirect()->route('user.account');
            }
        }
        $fillAllowEdit = [
            'name', 'phone'
        ];

        $parame = $request->all();
        foreach ($parame as $field => $value){
            if (in_array($field, $fillAllowEdit)){
                $user->$field = $value;
                continue;
            }
        }

        if( is_array($parame) && !empty($parame)){
            $user->save();
        }

        Session::flash('success','Cập nhật thành công');
        return redirect()->route('user.account');
    }
    public function getOrder(){
        $userId = Auth::user()->id;
        $orders = DB::table('orders')
            ->where('usr_id',$userId)
            ->join('payment_method','orders.pay_mth_id','=','payment_method.id')
            ->join('payment_status','orders.pay_sta_id','=','payment_status.id')
            ->join('status','orders.sta_id','=','status.id')
            ->select('orders.*', 'payment_method.name as pay_mth_name', 'payment_status.name as pay_sta_name', 'status.name as sta_name')
            ->orderBy('created_at','desc')
            ->get();
        foreach ($orders as $order){
            $orderProduct = DB::table('order_product')
                ->join('products','order_product.pro_id','=','products.id')
                ->where('ord_id',$order->id)
                ->select('order_product.*','products.name as product_name')
                ->get();
            $order->orderDetail = $orderProduct;
        }
        return view('user.order', ['orders'=>$orders]);
    }
    public function getOrderDetail($id){
        $order = DB::table('orders')
            ->where('orders.id',$id)
            ->join('payment_method','orders.pay_mth_id','=','payment_method.id')
            ->join('payment_status','orders.pay_sta_id','=','payment_status.id')
            ->join('status','orders.sta_id','=','status.id')
            ->select('orders.*', 'payment_method.name as pay_mth_name', 'payment_status.name as pay_sta_name', 'payment_status.id as pay_sta_id', 'status.name as sta_name')
            ->first();
            $orderProduct = DB::table('order_product')
                ->join('products','order_product.pro_id','=','products.id')
                ->join('brands','products.bra_id','=','brands.id')
                ->join('product_image','products.id','=','product_image.pro_id')
                ->where('ord_id',$id)
                ->where('product_image.active',1)
                ->select('order_product.*','products.name as pro_name','products.code as pro_code', 'brands.name as bra_name','brands.id as bra_id', 'product_image.img as pro_img')
                ->get();
        $order->orderDetail = $orderProduct;
        return view('user.orderDetail',['order' => $order]);
    }
    public function getReview(){
        $userId = Auth::user()->id;
        $reviews = DB::table('reviews')
            ->where('usr_id',$userId)
            ->where('parent',0)
            ->paginate(20);
        foreach ($reviews as $review){
            $product = DB::table('products')
                ->where('products.id',$review->pro_id)
                ->where('product_image.active',1)
                ->leftJoin('product_image','products.id','=','product_image.pro_id')
                ->select('products.name','product_image.img')
                ->first();
            $review->pro_details = $product;
        }
        return view('user.review',['reviews' => $reviews]);
    }
}
