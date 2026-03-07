<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ProfileRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\Order;

class MypageController extends Controller
{
    public function index(Request $request) {
        $products = Product::where('seller_id', auth()->id())->get();
        $orders = Order::where('buyer_id', auth()->id())->get();
        $page = $request->input('page','sell');

        return view('mypage.index', compact('products','orders','page'));
    }

    public function edit( ) {
        return view('mypage.profile');
    }

    public function update(ProfileRequest $request) {
       $user = Auth::user();

       if ($request->hasfile('profile_image')) {
        $path = $request->file('profile_image')->store('profiles', 'public');
        $user->profile_image = $path;
       } 

       $user -> fill($request->only([
        'name',
        'postal_code',
        'address',
        'building',
       ]));

       $user -> save();
       

        return redirect('/');
    }
}
