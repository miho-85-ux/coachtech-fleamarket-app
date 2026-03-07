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

        $tab = $request->input('tab');

        if ($tab === 'mylist') {
            if (auth()->check()) {
                $query = auth()->user()->likedProducts();
            } else {
                $query = Product::whereRaw('0 = 1');
            }
        } else {
            $query = Product::query();
        }

        if (auth()->check()) {
            $query->where('seller_id', '!=', auth()->id());
        }

        $query->where('status', '!=', 'sold')->withCount('likes')->orderByDesc('likes_count');
                        
        if ($request->filled('name')) {
            $query -> where('name', 'like', '%'. $request->name. '%');
        }

        $products = $query->paginate(12)->withQueryString();
        
        return view('index', compact('products'));
    }
            
    public function detail($item) {
        $product = Product::with('categories')->find($item);

        return view('item', compact('product'));
    }


}
