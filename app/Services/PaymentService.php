<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

/**
 * Class PaymentService.
 */
class PaymentService
{
    public static function getAuthenticationToken()
    {
        $response = Http::post('https://accept.payment.com/api/auth/tokens',[
            'api_key' => env('PAYMENT_API_KEY')
        ]);
        return $response->json()['token'];
    }
    public static function orderRegistration($body)
    {
        $response = Http::post('https://accept.payment.com/api/ecommerce/orders',$body);
        return $response->json()['id'];
    }
    public static function paymentKey($body)
    {
        $response = Http::post('https://accept.payment.com/api/acceptance/payment_keys',$body);
        return $response->json()['token'];
    }

    public static function getCartInformation(): array
    {
        $cart = session('cart') ?? [];
        if (empty($cart)) {
            return [];
        }
        $items = [];
        foreach ($cart as $product) {
            if (!is_array($product)) {
                continue;
            }
            $items[] = [
                'name' => $product['title'],
                'amount_cents' => 100 * $product['price'],
                'description' => $product['title'],
                'quantity' => $product['quantity'],
            ];
        }
        return [
            'items' => $items,
            'totalPrice' => (int) $cart['totalPrice'] * 100 ?? 0,
        ];
    }

}
