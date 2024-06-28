{{--@dd($cartProducts)--}}
@extends('Front.layouts.front-layout' , ['title' => 'Cart'])
@section('content')
    @vite('resources/js/cart.js')
    <div class="untree_co-section before-footer-section">
        <div class="container">
            <div class="col-md-8 col-lg-12 pb-4">
                @if(session('success'))
                    <div class="alert alert-success text-center">
                        {{session('success')}}
                    </div>
                @endif
            </div>
            <div class="row mb-5">

                <form class="col-md-12" method="post">
                    <div class="site-blocks-table">
                        <table class="table" id="productTable">
                            @if(!(empty($carts)))
                                <thead>
                                <tr>
                                    <th class="product-thumbnail">Image</th>
                                    <th class="product-name">Product</th>
                                    <th class="product-price">Price</th>
                                    <th class="product-quantity">Quantity</th>
                                    <th class="product-total">Total</th>
                                    <th class="product-remove">Remove</th>
                                </tr>
                                </thead>
                            @endif

                            <tbody>
                            @forelse($carts as $cart)
                                @if(!is_array($cart))
                                    @continue
                                @endif
                                <tr>
                                    <td class="product-thumbnail">
                                        <img src="{{$cart['imageUrl']}}" alt="Image" class="img-fluid">
                                    </td>
                                    <td class="product-name">
                                        <h2 class="h5 text-black">{{$cart['title']}}</h2>
                                    </td>
                                    <td class="product-price">${{$cart['price']}}</td>
                                    <td>
                                        <div class="input-group mb-3 d-flex align-items-center quantity-container"
                                             style="max-width: 120px;">
                                            <div class="input-group-prepend">
                                                <button class="btn btn-outline-black decrease"
                                                        data-id="{{$cart['id']}}" type="button">&minus;
                                                </button>
                                            </div>
                                            <input type="text" class="form-control text-center quantity-amount"
                                                   value="{{$cart['quantity'] ?? 1}}" placeholder=""
                                                   aria-label="Example text with button addon"
                                                   aria-describedby="button-addon1">
                                            <div class="input-group-append">
                                                <button class="btn btn-outline-black increase"
                                                        data-id="{{$cart['id']}}" type="button">&plus;
                                                </button>
                                            </div>
                                        </div>

                                    </td>
                                    <td>${{$cart['price'] * $cart['quantity']}}</td>
                                    <td><a class="btn btn-black btn-sm remove" data-id="{{$cart['id']}}">X</a></td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">No Products Found</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </form>
            </div>

            @if(!empty($carts))
                <div class="row" id="cartPrices">
                    <div class="col-md-6">
                        <div class="row mb-5">
                            <div class="col-md-6">
                                <a href="{{route('products.index')}}" class="btn btn-outline-black btn-sm btn-block">Continue
                                    Shopping</a>
                            </div>
                        </div>
                        <form action="{{route('coupon.check')}}" method="post">
                            <div class="row">
                                @csrf
                                <div class="col-md-12">
                                    <label class="text-black h4" for="coupon">Coupon</label>
                                    <p>Enter your coupon code if you have one.</p>
                                </div>
                                <div class="col-md-8 mb-3 mb-md-0">
                                    <input type="text" name="code" class="form-control py-3" id="coupon"
                                           placeholder="Coupon Code">
                                </div>
                                <div class="col-md-4">
                                    <button class="btn btn-black">Apply Coupon</button>
                                </div>
                                @error('code')
                                <div class="col-md-12">
                                    <span class="text-danger">{{$message}}</span>
                                </div>
                                @enderror
                            </div>
                        </form>
                    </div>
                    <div class="col-md-6 pl-5">
                        <div class="row justify-content-end">
                            <div class="col-md-7">
                                <div class="row">
                                    <div class="col-md-12 text-right border-bottom mb-5">
                                        <h3 class="text-black h4 text-uppercase">Cart Totals</h3>
                                    </div>
                                </div>
                                <div class="row mb-5">
                                    <div class="col-md-6">
                                        <span class="text-black">Total</span>
                                    </div>
                                    <div class="col-md-6 text-right">
                                        <strong class="text-black"
                                                id="totalPrice">${{$carts['totalPrice']}}</strong>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <form action="{{route('payment.checkout')}}" method="post">
                                            @csrf
                                            <button class="btn btn-black btn-lg py-3 btn-block"
                                                    onclick="window.location='checkout.html'">Proceed To Checkout
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

        </div>
    </div>
@endsection
