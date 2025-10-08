<?php

namespace App\Http\Controllers;

use App\Http\Requests\ExhibitionRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\Category;

class ItemController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::query();
        if ($request->query('tab') === 'mylist'){
            if (!auth()->check()) {
                $products = collect();
                return view('index' , [
                    'products' => $products,
                    'activeTab' => $request->query('tab', 'all'),
                ]);
            }
            $userId = auth()->id();
            $query->whereHas('likes', fn($q) => $q->where('user_id', $userId));
        }
        $products = $query->latest()->paginate(20);
        return view('index', [
            'products' => $products,
            'activeTab' => $request->query('tab', 'all'),
        ]);
    }
    
    public function show($item_id)
    {
        $product = \App\Models\Product::withCount(['likes','comments'])
        ->with(['comments' => fn($q) => $q->latest()->with('user')])
        ->findOrFail($item_id);
        
        $likedByMe = auth()->check()
        ? $product->likes()->where('user_id', auth()->id())->exists()
        : false;
        
        return view('item', compact('product','likedByMe'));
    }

    public function create()
    {
        $categories = \App\Models\Category::all();
        return view('sell', compact('categories'));
    }
    public function store(ExhibitionRequest $request)
    {
        $validated = $request->validate();
        if ($request->hasFile('image_path')) {
            $path = $request->file('image_path')->store('products', 'public');
            $validated['image_path'] = 'storage/' . $path;
        }
        $validated['user_id'] = auth::id();
        $product = Product::create($validated);
        
        $product->categories()->attach($validated['categories']);
        return redirect()->route('index', ['item_id' => $product->id]);
    }
}
