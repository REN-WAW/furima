<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Product;
use App\MOdels\Like;

class LikeController extends Controller
{
    public function toggle(Request $request, $item_id)
    {
        $product = \App\Models\Product::findOrFail($item_id);
        $userId = auth()->id();
        
        $existing = $product->likes()->where('user_id', $userId)->first();
        
        if ($existing) {
            $existing->delete();
            $liked = false;
        } else {
            $product->likes()->create(['user_id' => $userId]);
            $liked = true;
        }
        
        if (request()->wantsJson()) {
            return response()->json([
                'liked' => $liked,
                'likes_count' => $product->likes()->count(),
            ]);
        }
        return back();
    }
}
