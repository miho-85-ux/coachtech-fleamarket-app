<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ProfileRequest;
use App\Models\Category;
use App\Models\Product;

class MypageController extends Controller
{
    public function index( ) {
        $query = Product::with('categories');
        $products = $query->paginate(12)->withQueryString();

        return view('mypage.index', compact('products'));
    }

    public function edit( ) {
        return view('mypage.profile');
    }

    public function update(Request $request) {
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
