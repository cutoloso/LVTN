<?php

namespace App\Http\Controllers;

use DB, Cart, Session;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function addToCart($id)
    {
        /**
         * Kiem tra trong gio hang da co san pham hay chua
         */
        if (Cart::count() > 0) {
            /**
             * Truong hop da co roi, lay tat ca danh sach san pham
             */
            $cartProducts = Cart::content();
            /**
             * Khai bao bien kiem tra san pham da co trong gio hang hang chua
             */
            $checkProduct = true;
            /**
             * Khai bao mang push san pham vao gio hang
             */
            $params = [];
            /**
             * Lap danh sach san pham trong gio hang
             */
            foreach ($cartProducts as $rowId => $cartProduct) {
                /**
                 * Kiem tra neu san pham da co trong gio hang thi gan bien check san pham la false
                 */
                if ($cartProduct->id == $id)
                    $checkProduct = false;
                /**
                 * Push san pham lai gio hang vao mang, vi trong gio hang la mang doi tuong nen phai gan lai
                 */
                array_push($params, [
                    'id'        => $cartProduct->id,
                    'name'      => $cartProduct->name,
                    'qty'       => 1,
                    'price'     => $cartProduct->price,
                    'weight'    => 0,
                    'options'   => [
                        'price_sale'    => $cartProduct->options->price_sale,
                        'img'   => $cartProduct->options->img,
                        'bra_name'  => $cartProduct->options->bra_name
                    ]
                ]);
            }
            /**
             * Neu bien kiem tra san pham la true, co nghia la san pham khong trong gio hang, tien hanh them vao gio hang
             */
            if ($checkProduct) {
                /**
                 * Lay thong tin san pham
                 */
                $product = DB::table('products')->where('id', $id)->first();
                /**
                 * Khai bao mang thong tin san pham push vao mang
                 */
                $productImage = DB::table('product_image')->where('pro_id', $id)->where('active', 1)->first();
                /**
                 * Lay hinh anh cua san pham
                 */
                $brand = DB::table('brands')->where('id', $product->bra_id)->first();
                /**
                 * Lay nhãn hiệu
                 */
                $data = [
                    'id'        => $product->id,
                    'name'      => $product->name,
                    'qty'       => 1,
                    'price'     => $product->price,
                    'weight'    => 0,
                    'options'   => [
                        'price_sale'    => $product->price_sale,
                        'img'           => $productImage->img,
                        'bra_name'      => $brand->name
                    ]
                ];
                /**
                 * Push san pham moi vao gio hang
                 */
                array_push($params, $data);
                /**
                 * Them mang san pham vao gio hang
                 */
                Cart::destroy();
                Cart::add([$params]);
            }
        }
        else {
            $product = DB::table('products')->where('id', $id)->first();
            $brand = DB::table('brands')->where('id', $product->bra_id)->first();
            $productImage = DB::table('product_image')->where('pro_id', $id)->where('active', 1)->first();
            Cart::add([
                'id'        => $product->id,
                'name'      => $product->name,
                'qty'       => 1,
                'price'     => $product->price,
                'weight'    => 0,
                'options'   => [
                    'img'           => $productImage->img,
                    'price_sale'    => $product->price_sale,
                    'bra_name'      => $brand->name
                ]
            ]);
        }
        return response()->json([
            'cartCount' => Cart::count(),
            'total_price'=> getTotalPrice()
            ]);
    }

    public function getCart(){
        $cartProducts = Cart::content();
        if (Cart::count()==0){
            Session::flash('false', 'Giỏ hàng không có sản phẩm. Vui lòng quay lại mua sắm.');
        }
        return view('shop.cart',compact('cartProducts', $cartProducts));
    }
    public function emptyCart(){
        $cartProducts = Cart::truncate();
        return dd(Cart::content());
    }
    public function deleteCartItem($rowId){
        Cart::remove($rowId);
        if (Cart::count() != 0){
            Session::flash('success', 'Đã xóa 1 sản phẩm khỏi giỏ hàng');
        }
        return redirect()->route('get-cart');
    }
    public function updateCartItem($rowId, Request $request){
        $cartItem = Cart::get($rowId);
        if ($cartItem){
            Cart::update($rowId, ['qty' => $request->qty]);
            return response(['cartProduct',$cartItem]);
        }
    }

    public function buyNow($id){
        $this->addToCart($id);
        return redirect()->route('get-checkout');
    }
}
