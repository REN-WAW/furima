@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/purchase.css') }}">
@endsection

@section('content')
<div class="purchase-form">
    <form method="POST" action="{{ route('purchase.store', $product->id) }}">
        @csrf
        <div class="purchase__left-content">
            <div class="purchase__product">
                <img src="{{ asset($product->image_path) }}" alt="{{ $product->title }}" class="img-content" />
                <h2 class="product-title">{{ $product->title }}</h2>
                <h2 class="product-price">¥{{ $product->price }}</h2>
            </div>
            
            <div class="purchase__payment">
                <p>支払い方法</p>
                <select class="payment__method" name="payment_method">
                    <option disabled selected>選択してください</option>
                    <option value="1">コンビニ払い</option>
                    <option value="2">カード支払い</option>
                </select>
            </div>
            
            <div class="purchase__address">
                <p>配送先</p>
                <span class="postcode">{{ $user->postcode }}"</span>
                <span class="address">{{ $user->address }} {{ $user->building }}</span>
                <label class="address__change">
                    <a href="{{ route('mypage.edit') }}">変更する</a>
                </label>
            </div>
        </div>
        <button type="submit">購入する</button>
    </form>
</div>
@endsection
