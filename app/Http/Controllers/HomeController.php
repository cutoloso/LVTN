<?php

namespace App\Http\Controllers;
use App\Review;
use DB, App\Customer, Auth, Cart;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
//    public function __construct()
//    {
//        $this->middleware('auth');
//    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(){
        $banners = DB::table('banners')->get();
        $best_sale = DB::table('products')
            ->where('products.active',1)
            ->where('products.best_sale',1)
            ->leftJoin('product_image','products.id','=','product_image.pro_id')
            ->where('product_image.active',1)
            ->select('products.*','product_image.img')
            ->get();
        $best_feature = DB::table('products')
            ->where('products.active',1)
            ->where('products.best_feature',1)
            ->leftJoin('product_image','products.id','=','product_image.pro_id')
            ->where('product_image.active',1)
            ->select('products.*','product_image.img')
            ->get();
        return view('home.index',[
            'banners'       => $banners,
            'best_sale'     => $best_sale,
            'best_feature'  => $best_feature,
        ]);
    }

    /**
     * Lấy sản phẩm theo id category
     */
    public function getProductByCategory(Request $request){
        $option = $request->option;
        switch ($option){
            case "best_sale":
                $result = DB::table('products')
                    ->where('products.active',1)
                    ->where('products.best_sale',1)
                    ->leftJoin('product_image','products.id','=','product_image.pro_id')
                    ->where('product_image.active',1)
                    ->select('products.*','product_image.img');
                break;
            case "best_feature":
                $result = DB::table('products')
                    ->where('products.active',1)
                    ->where('products.best_feature',1)
                    ->leftJoin('product_image','products.id','=','product_image.pro_id')
                    ->where('product_image.active',1)
                    ->select('products.*','product_image.img');
                break;
        }
        if ($request->bra_id === '-1') {
            return $result->get();
        }
        else{
            return $result->where('products.bra_id', $request->bra_id)->get();
        }
    }

    public function getProductByBrand($bra_id){
        $products = DB::table('products')
            ->where('products.active','1')
            ->leftJoin('product_image','products.id','=','product_image.pro_id')
            ->where('product_image.active',1)
            ->select('products.*','product_image.img')
            ->where('products.bra_id', $bra_id)
            ->get();
        return view('seach.brand',['products'=>$products]);
    }
    /**
     * get single-page theo id sản phẩm
     */
    public function getSingle($id){
        $product = DB::table('products')->where('id', $id)->first();
        $brand = DB::table('brands')->where('id', $product->bra_id)->first();
        $productImage = DB::table('product_image')->where('pro_id', $id)->orderBy('active','DESC')->get();
        $att_vals = DB::table('attribute_value')->where('pro_id',$id)
            ->leftJoin('attributes','attribute_value.att_id','=','attributes.id')
            ->select('attribute_value.*','attributes.name')
            ->orderBy('attributes.id')
            ->get();

        $relatedProducts = DB::table('products')
            ->where('bra_id', $product->bra_id)
            ->leftJoin('product_image','products.id','=','product_image.pro_id')
            ->where('product_image.active',1)
            ->select('products.*','product_image.img')
            ->get();
        $reviews = DB::table('reviews')
            ->select('reviews.*', 'users.name as usr_name')
            ->where('parent',0)
            ->leftJoin('users','users.id','reviews.usr_id')
            ->orderBy('reviews.created_at','desc')
            ->get();
        $totalStar = count($reviews);
        foreach ($reviews as $item){
            $subReviews = DB::table('reviews')->where('parent',$item->id)->get();
            if($subReviews){
                $arrSub = [];
                foreach ($subReviews as $sub){
                    $tempSub = DB::table('reviews')
                        ->select('reviews.*', 'users.name as usr_name')
                        ->where('reviews.id',$sub->id)
                        ->leftJoin('users','users.id','reviews.usr_id')
                        ->orderBy('reviews.created_at','desc')
                        ->first();
                    array_push($arrSub,$tempSub);
                }
                $item->subReview = $arrSub;
            }
        }
        $avgStar = DB::table('reviews')->avg('star');
        return view('shop.single',[
            'product'           =>$product,
            'bra_name'          =>$brand->name,
            'productImages'     => $productImage,
            'relatedProducts'   => $relatedProducts,
            'att_vals'          => $att_vals,
            'reviews'           => $reviews,
            'avgStar'           => (int)round($avgStar),
            'totalStar'         => $totalStar,
        ]);
    }
    /**
     * get
     */
    public  function getCheckOut(){
        $user = Auth::user();
        $customer = Customer::firstOrCreate(
            ['usr_id' => $user->id],
            ['name' => $user->name, 'email' => $user->email, 'address' => $user->address, 'phone' => $user->phone]
        );

        return view('shop.checkout',['customer' => $customer]);
    }

    public function getRegion(){
        $regions = DB::table('devvn_tinhthanhpho')->orderBy('name')->get();
        return response()->json(['regions'=> $regions]);
    }

    public function getCity($matp){
        $cityes = DB::table('devvn_quanhuyen')->where('matp',$matp)->orderBy('name')->get();
        return response()->json(['cityes'=> $cityes]);
    }

    public function getWard($maqh)
    {
        $wards = DB::table('devvn_xaphuongthitran')->where('maqh', $maqh)->orderBy('name')->get();
        return response()->json(['wards' => $wards]);
    }

    public function getPayment($option){
        if ($option == "default"){
            $user = Auth::user();
            $customer = $user;
            $cartProducts = Cart::content();
            return view('shop.payment',[
                'customer'      => $customer,
                'cartProducts'  => $cartProducts
            ]);
        }
        $usr_id = Auth::user()->id;
        $customer = Customer::where('usr_id',$usr_id)->first();
        $cartProducts = Cart::content();
        return view('shop.payment',[
            'customer'      => $customer,
            'cartProducts'  => $cartProducts
        ]);
    }

    public function getCompare($pro1, $pro2){
        $imagesPro1 = DB::table('product_image')->where('pro_id',$pro1)->get();
        $product1 = DB::table('products')->where('id', $pro1)->first();
        $att_vals = DB::table('attribute_value')->where('pro_id',$pro1)
            ->leftJoin('attributes','attribute_value.att_id','=','attributes.id')
            ->select('attributes.name','attribute_value.att_value')
            ->orderBy('attributes.id')
            ->get();
        $arrAttPro1 = [];
        foreach ($att_vals as $att1){
            array_push($arrAttPro1, $att1);
        }
        $product1->attribute = $arrAttPro1;
        $product2 = DB::table('products')->where('id', $pro2)->first();
        $imagesPro2 = DB::table('product_image')->where('pro_id',$pro2)->get();
        $att_vals2 = DB::table('attribute_value')->where('pro_id',$pro2)
            ->leftJoin('attributes','attribute_value.att_id','=','attributes.id')
            ->select('attribute_value.*','attributes.name')
            ->orderBy('attributes.id')
            ->get();
        $arrAttPro2 = [];
        foreach ($att_vals2 as $att2){
            array_push($arrAttPro2, $att2);
        }
        $product2->attribute = $arrAttPro2;

        $prod1 = DB::table('reviews')->where('pro_id',$pro1);
        $totalReview1 = $prod1->count();
        $avgReview1 = $prod1->avg('star');

        $prod2 = DB::table('reviews')->where('pro_id',$pro2);
        $totalReview2 = $prod2->count();
        $avgReview2 = $prod2->avg('star');
        return view('shop.compare',[
            'product1'      => $product1,
            'product2'      => $product2,
            'imagesPro1'    => $imagesPro1,
            'imagesPro2'    => $imagesPro2,
            'totalReview1'  => $totalReview1,
            'avgReview1'    => $avgReview1,
            'totalReview2'  => $totalReview2,
            'avgReview2'    => $avgReview2,
        ]);
    }

    public function search(Request $request){
        $key = $request->key;
        $result = DB::table('products')
            ->leftJoin('product_image','products.id','=','product_image.pro_id')
            ->where('product_image.active',1)
            ->where(function ($query) use ($key){
                $query->where('name', 'like', '%'.$key.'%')
                    ->orwhere('alias', 'like', '%'.$key.'%');
            })
            ->select('products.id','products.name','products.price','products.price_sale','product_image.img')
            ->get();
        return response()->json(['result'=>$result]);
    }

    public function filter(Request $request){
        $banners = DB::table('banners')->get();
        $brands = DB::table('brands')->get();
        $products = DB::table('products')
            ->where('products.active',1)
            ->leftJoin('product_image','products.id','=','product_image.pro_id')
            ->where('product_image.active',1)
            ->select('products.*','product_image.img');
        if ($request->has('bra_id')){
            $products->where('bra_id',$request->bra_id);
        }
        $filterable = [
            'name',
            'code',
            'alias',
            'price',
            'price_sale',
            'parent',
            'active',
            'sup_id',
            'att_gr_id',
            'best_feature',
            'best_sale'
        ];

        $query = $products;
        $param = $request->all();

        if (!isset($request->sort)){
            $query->orderBy('created_at','desc');
        }
        foreach ($param as $field => $value){
            if ($value === ''){
                continue;
            }

            if (empty($filterable) || !is_array($filterable)){
                continue;
            }

            if (in_array($field, $filterable)){
                $query->where('products.'.$field, $value);
                continue;
            }

            if (key_exists($field, $filterable)){
                $query->where('products.'.$filterable[$field], $value);
                continue;
            }

            if ($field == 'min_price'){
                $query->where('products.price','>=', $value);
                continue;
            }

            if ($field == 'max_price'){
                $query->where('products.price','<=', $value);
                continue;
            }

            if ($field == 'sort'){
                $query->orderBy('price_sale',$value);
                continue;
            }

        }

        return view('shop.category',[
            'banners'      => $banners,
            'products'     => $query->paginate(30),
            'brands'       => $brands
        ]);
    }

}
