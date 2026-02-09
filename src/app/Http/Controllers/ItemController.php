<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use App\Models\Category;

class ItemController extends Controller
{
    public function index(Request $request) {
        $query = Product::with('categories');

        if (auth()->check() && auth()->user()->postal_code === null) {
        return redirect('/mypage/profile');
        }
        
        if ($request->filled('name')) {
            $query -> where('name', 'like', '%'. $request->name. '%');
        }
        $products = $query->paginate(12)->withQueryString();

        $products = Product::withCount('likes')->orderBy('likes_count', 'desc')->get();
            
        return view('index', compact('products'));
    }
            
    public function detail($id) {
        $product = Product::with('categories')->find($id);

        return view('item', compact('product'));
    }


}
