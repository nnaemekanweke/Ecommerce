<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Session;


class CouponController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $coupon = Coupon::where('code', $request->coupon_code)->first();
      //  dd($coupon);

        if(!$coupon)
        {
           return redirect()->route('cart.index')->withErrors('Invalid');
        }

            session()->put('coupon', [
                'name' => $coupon->code,
                'discount' => $coupon->discount(Cart::subtotal()),
   
              ]);
            return redirect()->route('cart.index')->with('success_message', 'Coupon Applied');       

    }
        /**
     * Remove the specified resource from storage.
     *  
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
       session()->forget('coupon');

       return redirect()->route('cart.index')->with('success_message', 'Coupon Removed');
    }
}
