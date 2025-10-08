<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Purchase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PurchaseController extends Controller
{
    public function create($item_id)
    {
        $product = Product::with('categories')->findOrFail($item_id);
        $user = Auth::user();
        
        if ($product->user_id === $user->id) {
            return redirect()->route('item.show', $product->id)->with('error','自信の出品商品は購入できません。');
        }
        if ($product->sold) {
            return redirect()->route('item.show', $product->id)->with('error','この商品はすでに売り切れです。');
            return view('purchase', compact('product', 'user'));
    }
}
    
    public function store(Request $request, $item_id)
    {
        $product = Product::findOrFail($item_id);
        $product->sold = true;
        $product->save();

        return redirect()->route('item.show', $product->id)->with('status', '購入が完了しました！');
    }
}