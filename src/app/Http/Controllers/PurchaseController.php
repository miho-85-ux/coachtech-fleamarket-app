<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\AddressRequest;
use App\Http\Requests\PurchaseRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\Order;
use App\Models\User;
use Stripe\Stripe;
use Stripe\Checkout\Session;


class PurchaseController extends Controller
{
    public function index($item) {
        $product = Product::find($item);
        $user = auth()->user();
        $shipping = session('shipping');
        
        return view('purchase', compact('product', 'user', 'shipping'));
    }
        
    public function indexAddress($item) {
        $product = Product::find($item);
        $user = auth()->user();
        
        return view('address', compact('product', 'user'));
    }
        
    public function editAddress(AddressRequest $request, $item) {
        $request->session()->put('shipping', [
            'shipping_postal_code'=> $request->shipping_postal_code,
            'shipping_address'=> $request->shipping_address,
            'shipping_building'=> $request->shipping_building,
        ]);
        
        return redirect()->route('purchase.index', ['item' => $item]);
    }
        
    public function store(PurchaseRequest $request, $item) {
        $product = Product::find($item);
        $request->session()->put('purchase', [
            'payment_method' => $request->payment_method,
        ]);

        if ($request->payment_method == 2) {
            Stripe::setApiKey(config('services.stripe.secret'));
            $session = Session::create([
                'payment_method_types' => ['card'],
                'line_items' => [[
                    'price_data' => [
                        'currency' => 'jpy',
                        'product_data' => ['name' => $product->name,],
                        'unit_amount' => $product->price,
                    ],
                    'quantity' => 1,
                ]],
                'mode' => 'payment',
                'success_url' => url('/purchase/success', $item),
                'cancel_url' => url('/purchase/',$item),
            ]);
            return redirect($session->url);
        }    

        return redirect('/purchase/success/'. $item);   
    }

    public function success(Request $request, $item) {
        $shipping = $request->session()->get('shipping');
        $purchase = $request->session()->get('purchase');
        $product = Product::find($item);
        Order::create([
            'buyer_id' => auth()->id(),
            'product_id' => $item,
            'payment_method' => $purchase['payment_method'],
            'shipping_postal_code' => $shipping['shipping_postal_code'] ?? null,
            'shipping_address' => $shipping['shipping_address'] ?? null,
            'shipping_building' => $shipping['shipping_building'] ?? null,
        ]); 
        
        $request->session()->forget('shipping');

        return redirect('/')->with('purchase_success', '購入いたしました');
    }
}
