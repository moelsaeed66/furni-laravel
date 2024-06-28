<?php
namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Services\PaymentService;
use Illuminate\Support\Facades\Redirect;


class PaymentController extends Controller
{
    public function pay()
    {
        $cartInformation = PaymentService::getCartInformation();
        $token = PaymentService::getAuthenticationToken();
        $order_id = PaymentService::orderRegistration([
            'auth_token' => $token,
            'delivery_needed' => 'false',
            'currency' => 'EGP',
            'items' => $cartInformation['items'], // Adding Items Later
            'amount_cents' => $cartInformation['totalPrice']  ,
        ]);

        $payment_key = PaymentService::paymentKey([
            'auth_token' => $token,
            'amount_cents' => $cartInformation['totalPrice'],
            'expiration' => 3600,
            'currency' => 'EGP',
            'order_id' => $order_id,
            'billing_data' => [
                'apartment' => '803',
                'email' => 'test@exampl.com',
                'floor' => '42',
                'first_name' => 'John',
                'street' => 'Ethan Hunt',
                'building' => '802',
                'phone_number' => '+201011122233',
                'shipping_method' => 'PKG',
                'postal_code' => '01898',
                'city' => 'Johannesburg',
                'country' => 'EG',
                'last_name' => 'Doe',
                'state' => 'NA',
            ],
            'integration_id' => env('PAYMENT_INTEGRATION_ID'),
        ]);
        Order::create(
            [
                'user_id' => auth()->id(),
                'order_id' => $order_id,
                'total_amount' => $cartInformation['totalPrice'] / 100,
                'transaction_status' => 'pending',
            ]
        );
        return Redirect::away('https://accept.paymob.com/api/acceptance/iframes/781592?payment_token='.$payment_key);

    }
    public function callback(Request $request):void
    {

        $order_id = $request->obj['order']['id'];
        $transaction_id = $request->obj['id'];
        $order = Order::where('order_id', $order_id)->first();
        if ($request->obj['success']) {
            $order->update([
                'transaction_status' => 'success',
                'transaction_id' =>$transaction_id
            ]);
            return;
        }
        $order->update([
            'transaction_status' => 'failed',
            'transaction_id' => $transaction_id
        ]);
    }
    public function success()
    {
        return redirect()->route('cart.index')->with('success', 'Payment was successful');
    }
}
