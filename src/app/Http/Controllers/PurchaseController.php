<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Purchase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PurchaseController extends Controller
{
    public function showPurchaseForm(Product $item)
    {
        $user = Auth::user();
        
        if(!$user) {
            return redirect('/login')->with('error','購入にはログインが必要です。');
        }
        return view('purchase', compact('item', 'user'));
    }
    public function store(Request $request, Product $item)
    {
        $product = Product::findOrFail($item_id);
        $product->sold = true;
        $product->save();

        return redirect()->route('/')->with('status', '購入が完了しました！');
    }
}