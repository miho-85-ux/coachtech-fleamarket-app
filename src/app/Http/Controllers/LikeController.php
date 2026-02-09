<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\Like;

class LikeController extends Controller
{
    public function toggle(Product $product) {
        
        $user = auth() -> user();

        $like = Like::where('user_id' , $user->id) -> where('product_id', $product->id)->first();

        if($like){
            $like->delete();
        }else{
            Like::create([
                'user_id' => $user->id,
                'product_id' => $product->id,
            ]);
        }

        return back();

    }
}
