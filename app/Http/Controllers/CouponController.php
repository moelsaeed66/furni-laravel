<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    public function checkCoupon(Request $request)
    {
        $coupon = Coupon::select('value','validity')->where('code', $request->validated())->first();
        if (!$coupon || $coupon->validity === 'inactive'){
            return back()->withErrors(['code' => 'Invalid Coupon or Expired']);
        }
        $this->applyCoupon($coupon);
        return back()->with('success', 'Coupon Applied Successfully');

    }

    protected function applyCoupon($coupon): void
    {
        $cart = session('cart' , []);
        $cart['totalPrice'] *=  ($coupon->value / 100);
        session(['cart' => $cart]);
        $coupon->update(['validity' => 'inactive']);
    }
}
