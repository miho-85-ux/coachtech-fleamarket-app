<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Http\Requests\ExhibitionRequest;

class SellController extends Controller
{
    public function index () {
        $categories = Category::all();

        return view('sell', compact('categories'));
    }

    public function store (ExhibitionRequest $request) {
        $data = $request->all();
        
        if($request->hasFile('image')) {
            $path = $request->file('image')->store('images', 'public');
            $data['image'] = $path;
        }
            
        $data['status'] = '販売中';
        auth()->user()->products()->create($data);

       return redirect('/');
    }
}
