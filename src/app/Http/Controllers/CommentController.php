<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;
use App\Models\Comment;
use App\Http\Requests\CommentRequest;

class CommentController extends Controller
{
    public function store(CommentRequest $request, Product $product) {
        Comment :: create([
            'user_id' => auth()->id(),
            'product_id' => $product_id,
            'content' => $request->content,
        ]);
        
        return redirect()->back();
    }
}
