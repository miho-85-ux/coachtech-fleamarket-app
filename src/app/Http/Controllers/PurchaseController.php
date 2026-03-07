<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\AddressRequest;
use App\Http\Requests\PurchaseRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\Order;
use App\Models\User;


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
            'payment_method' => $request->payment_method,
        ]);

        return redirect()->route('purchase.index', ['item' => $item]);
    }

    public function store(PurchaseRequest $request, $item) {
        $shipping = $request->session()->get('shipping');
        Order::create([
            'buyer_id' => auth()->id(),
            'product_id' => $item,
            'payment_method' => $shipping->payment_method ?? null,
            'shipping_postal_code' => $shipping['shipping_postal_code'] ?? null,
            'shipping_address' => $shipping['shipping_address'] ?? null,
            'shipping_building' => $shipping['shipping_building'] ?? null,
        ]); 
        
        $request->session()->forget('shipping');

        return redirect('/');
    }


}
