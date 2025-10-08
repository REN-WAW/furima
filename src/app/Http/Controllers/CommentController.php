<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(CommentRequest $request, $item_id)
    {
        $data = $request->validate([
            'comment' => 'required|string|max:1000',
        ]);
        $product = \App\Models\Product::findOrFail($item_id);
        
        $product->comments()->create([
            'user_id' => auth()->id(),
            'comment'    => $data['comment'],
        ]);

        return back()->with('status', 'コメントを投稿しました');
    }
}
