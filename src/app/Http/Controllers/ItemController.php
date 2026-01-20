<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use App\Models\Category;

class ItemController extends Controller
{
    public function index() {
        $products = Product::with('categories')->paginate(12);
        return view('index', compact('products'));
    }

    public function sarch(Request $request) {


    }

    public function detail($product) {

        return view('item');
    }
}
