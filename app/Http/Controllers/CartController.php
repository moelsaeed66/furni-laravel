<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CartController extends Controller
{
    public function index()
    {
        $carts=session('cart')??[];
        return view('front.cart.index',compact('carts'));
    }

    public function store(Request $request)
    {
        $cart=session('cart',[]);
        $product_id=$request->id;
        if(isset($carts[$product_id]))
        {
            $cart[$product_id]['quantity']++;
        }
        else {
            $product = Product::select('id', 'name', 'price', 'image')->find($product_id);
            if (!$product)
            {
                return 'Product not found';
            }
        }

        $cart[$product_id] = [
            'id' => $product->id,
            'title' => $product->name,
            'price' => $product->price,
            'imageUrl' => $product->image_url, // Ensure attribute matches your model
            'quantity' => 1,
        ];


        $cart['totalPrice'] = $this->calculateTotalPrice($cart);

        session(['cart' => $cart]);
        return response()->json([
            'success' => true,
            'message' => 'Item added to the cart successfully.',
        ], Response::HTTP_OK);

    }

    public function update(Request $request)
    {
        $product_id = $request->id;
        $cart = session('cart') ?? [];
        if (isset($cart[$request->id])) {
            return $this->updateCart($product_id, $request->increment);
        }
        return false;
    }

    public function destroy(Request $request)
    {
        $cart = session('cart', []);
        if (isset($cart[$request->id])) {
            unset($cart[$request->id]);
            if (count($cart) == 1) $cart = [];
            session(['cart' => $cart]);
            return response()->json([
                'success' => true,
                'message' => 'Item removed successfully.',
            ], Response::HTTP_OK); // HTTP 200
        }

        // Return an error response if the item is not found
        return response()->json([
            'success' => false,
            'message' => 'Item not found in the cart.',
        ], Response::HTTP_NOT_FOUND); // HTTP 404
    }

    protected function updateCart($product_id, $isIncrement)
    {
        $cart = session('cart') ?? [];
        if ($isIncrement == 'true' && $cart[$product_id]['quantity'] >= 1) {
            $cart[$product_id]['quantity']++;
        } else if ($isIncrement == 'false' && $cart[$product_id]['quantity'] > 1) {
            $cart[$product_id]['quantity']--;
        } else {
            return false;
        }
        $cart['totalPrice'] = $this->calculateTotalPrice($cart);
        session(['cart' => $cart]);
        return  $cart['totalPrice'];
    }


    protected function calculateTotalPrice($carts): float|int
    {

        return array_reduce($carts, function ($carry, $product) {
            if (is_array($product)) {
                $carry += $product['price'] * $product['quantity'];
            }
            return $carry;
        }, 0);
    }

}
