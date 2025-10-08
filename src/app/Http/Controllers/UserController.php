<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use App\MOdels\product;

class UserController extends Controller
{
    public function show(Request $request)
    {
        $user = Auth::user();
        $activeTab = $request->query('tab', 'purchased');

        if($activeTab === 'purchased') {
            $products = \App\Models\Product::query()
            ->join('purchase', 'purchase.product_id', '=', 'products.id')
            ->where('purchase.buyer_id', $user->id)
            ->select('products.*')
            ->orderByDesc('purchase.created_at');
        }
        else{
            $products = $user->items();
            $activeTab = 'listed';
        }
        return view('profile', [
            'user' => $user,
            'products' => $products,
            'activeTab' => $activeTab,
        ]);
    }

    public function edit(Request$request)
    {
        $user = Auth::user();
        $firstTime = $request->query('first_time', 0);
        return view('setup', compact('user', 'firstTime'));
    }

    public function update(ProfileRequest $request)
    {
        $user = Auth::user();
        $data = $request->validated();
        
        if ($request->hasFile('icon_image')) {
            $path = $request->file('icon_image')->store('public/icons');
            $data['icon_image'] = str_replace('public/', 'storage/', $path);
        }
        $user->update($data);
        return redirect()->route('mypage.show');
    }
}
