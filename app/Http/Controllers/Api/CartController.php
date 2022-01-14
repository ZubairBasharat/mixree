<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Auth;
use App\EventFashion;
use Carbon\Carbon;
use Stripe\Order;
use OrderDetails;
use Stripe;
class CartController extends Controller
{
     /*/////////////////////////////////////
     Get Cart Items
     /////////////////////////////////////*/
      
     public function get_cart_items()
     {
       $cart_items = Db::table('carts as t1')
                   ->join('event_fashions as t2','t1.product_id','=','t2.id')
                   ->select('t1.*','t2.type','t2.name','t2.description','t2.image','t2.price')
                    ->where('t1.user_id',Auth::user()->id)->get();
       if(!empty($cart_items)){
        return response()->json(['status' => 200, 'message' => 'Items Found','Items'=>$cart_items]);
       }else{
        return response()->json(['status' => 200, 'message' => 'Not any Item available in record']);
       }
     }
     /*/////////////////////////////////////
     Add Products To Cart
     /////////////////////////////////////*/
    public function add_to_cart(Request $request)
    {
        $product = DB::table('event_fashions')->where('id',$request->event_id)->first();
        $check_product_rcd = DB::table('carts')->where('user_id',Auth::user()->id)->where('product_id',$request->event_id)->first();
        // return $check_product_rcd;
      if(!empty($check_product_rcd)){
         $updated_quantity = $check_product_rcd->product_quantity+1;
         $product_price = !empty($product->price)?$product->price:0;
         $data['product_quantity'] = $updated_quantity;
         $data['total_price'] = $product_price*$updated_quantity;
         $data['updated_at'] = Carbon::now();
         Db::table('carts')->where('product_id',$check_product_rcd->product_id)->where('user_id',Auth::user()->id)->update($data);
         $item =  Db::table('carts as t1')
                ->join('event_fashions as t2','t1.product_id','=','t2.id')
                ->select('t1.*','t2.type','t2.name','t2.description','t2.image','t2.price')
                ->where('t1.product_id',$check_product_rcd->product_id)->where('t1.user_id',Auth::user()->id)->get();
         return response()->json(['status' => 200, 'message' => 'Quantity Updated Successfully','item'=>$item]);
        }else{
        $data['user_id'] = Auth::user()->id;
        $data['event_id'] = $product->event_id;
        $data['product_id'] = $product->id;
        $data['product_quantity'] = 1;
        $data['total_price'] = !empty($product->price)?$product->price:0;
        $data['created_at'] = Carbon::now();
        $data['updated_at'] = Carbon::now();
        $qry  = DB::table('carts')->insert($data);
        $data['id'] = DB::getPdo()->lastInsertId();
        if($qry){
            $data['product_detail'] = Db::table('event_fashions as t1')->where('id', $product->id)->select('t1.type','t1.name','t1.description','t1.image','t1.price')->first();
            return response()->json(['status' => 200, 'message' => 'Add To Cart Successfully']);
        }else{
            return response()->json(['status' => 200, 'message' => 'Error:']);
        }
     }
    }
     /*/////////////////////////////////////
      Decrease Quantity from Cart
     /////////////////////////////////////*/

     public function decrease_quantity(Request $request)
     {
        $cart_product = Db::table('carts as t1')
                        ->join('event_fashions as t2','t1.product_id','=','t2.id')
                        ->where('t1.product_id',$request->product_id)->where('t1.user_id',Auth::user()->id)->first();
        $updated_quantity = $cart_product->product_quantity-1;
        if($updated_quantity>0){
            $product_price = !empty($cart_product->price)?$cart_product->price:0;
            $data['product_quantity'] = $updated_quantity;
            $data['total_price'] = $product_price*$updated_quantity;
            $data['updated_at'] = Carbon::now();
            Db::table('carts')->where('product_id',$cart_product->id)->where('user_id',Auth::user()->id)->update($data);
            $item =  Db::table('carts as t1')
                    ->join('event_fashions as t2','t1.product_id','=','t2.id')
                    ->select('t1.*','t2.type','t2.name','t2.description','t2.image','t2.price')
                    ->where('t1.product_id',$cart_product->id)->where('t1.user_id',Auth::user()->id)->get();
            return response()->json(['status' => 200, 'message' => 'Quantity Updated Successfully','item'=>$item]);
        }else{
            Db::table('carts')->where('product_id',$cart_product->id)->where('user_id',Auth::user()->id)->delete();
            return response()->json(['status' => 200, 'message' => 'Product Removed From Cart Successfully']);
        }             
     }

     /*/////////////////////////////////////
      Delete Product from Cart
     /////////////////////////////////////*/

     public function delete_product(Request $request)
     {
       $qry = DB::table('carts')->where('user_id',Auth::user()->id)->where('product_id',$request->product_id)->delete();
       if($qry){
           return response()->json(['status'=>200, 'message'=>'Item Removed From Cart Successfully']);
       }else{
        return response()->json(['status'=>200, 'message'=>'Error:']);
       }
     }

     /*/////////////////////////////////////
      CheckOut
     /////////////////////////////////////*/

     public function order(Request $request)
     {
        //  echo  $request->total_price*100;die;
        $cart_items = DB::table('carts')->where('user_id',Auth::user()->id)->get();
        Stripe\Stripe::setApiKey('sk_test_pZAt0My87sgRL5ARMfehzgz600DpyScMzf');
        $payment = Stripe\Charge::create ([
                "amount" => $request->total_price*100,
                "currency" => "USD",
                "source" => $request->stripe_token,
                "description" => "Making test payment." 
        ]);
        // return $payment;
        if(isset($payment->id)){
        if(!empty($cart_items))
        {
            $data['user_id'] = Auth::user()->id;
            $data['total_price'] = 0;
            $data['created_at'] = Carbon::now();
            $data['updated_at'] = Carbon::now();
            Db::table('orders_tables')->insert($data);
            $order_id = DB::getPdo()->lastInsertId();
            if($order_id)
            {
                $total_price = 0;
                foreach($cart_items as $cart_item)
                {   
                $event_id = EventFashion::where('id',$cart_item->product_id)->first()->event_id;
                $total_price += $cart_item->total_price;   
                $details['user_id'] = Auth::user()->id;
                $deta['event_id'] = $event_id;
                $details['order_id'] = $order_id;
                $details['product_id'] = $cart_item->product_id;
                $details['product_quantity'] = $cart_item->product_quantity;
                $details['total_price'] = $cart_item->total_price;
                $details['created_at'] = Carbon::now();
                $details['updated_at'] = Carbon::now();
                DB::table('order_details_tables')->insert($details);
                }
                $oder_table_data = [
                          'total_price' =>$total_price,
                          'payment_id'=>$payment->id,
                          'event_id' => $event_id,
                ];
                DB::table('orders_tables')->where('id',$order_id)->update($oder_table_data);
                DB::table('carts')->where('user_id',Auth::user()->id)->delete();
                return response()->json(['status'=>200, 'message'=>'Order placed Successfully']);
            }
        } 
        else
        {
            return response()->json(['status'=>200, 'message'=>'No Items Available in Cart']);
        }  
      } 
      else{
        return response()->json(['status'=>200, 'message'=>'Payment Unsuccessfull']);
      }
    }
      /*/////////////////////////////////////
       Total items Counter in Cart  
      /////////////////////////////////////*/
      public function cart_products_counter()
      {
         $items = DB::table('carts')->where('user_id',Auth::user()->id)->get();
         if(!empty($items))
         {
             return response()->json(['status'=>200, 'message'=>'Items Found In Cart','total_items'=>count($items)]);
         }
         else
         {
             return response()->json(['status'=>200, 'message'=>'N Items availabe In Cart','total_items'=>0]);
         }
      }

      /*/////////////////////////////////////
       Get Product Details  
      /////////////////////////////////////*/

      public function product_details(Request $request)
      {
          $product = DB::table('event_fashions')->select('id','type','name','description','image','price','link')->where('id',$request->product_id)->get();
          return response()->json(['status'=>200, 'message'=>'Produc Details','Details'=>$product]);
      }
}