@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/item.css') }}">
@endsection

@section('content')
<div class="contents">
    <div class="left-contents">
        <img src="{{ asset('storage/' . $product->image_path) }}" alt="{{ $product->title }}" class="img-content" />
    </div>
    
    <div class="right-content">
        <h1 class="product-title">{{ $product->title }}</h1>
        <p class="product-brand">{{ $product->brand }}</p>
        <h2 class="product-price">¥{{ $product->price }}</h2>
        <p>(税込)</p>
        <div class="meta">
            @auth
            <form action="{{ route('item.like', $product->id)}}" method="post" style="display:inline;">
                @csrf
                <button type="submit" class="like-button {{ $likedByMe ? 'is-liked' : '' }}">
                    ⭐️
                </button>
            </form>
            <span>💬</span>
            @else
            <a href="{{ route('login') }}" class="like-button">
                ⭐️
            </a>
            <span>💬</span>
            @endauth
        </div>
        <div class="count">
            <span>{{ $product->likes_count }}</span>
            <span>{{ $product->comments_count }}</span>
        </div>
            <form action="purchase/{item_id}" class="purchase__button-form" method="get">
                @csrf
                <button class="purchase__button" type="submit">
                    購入手続きへ
                </button>
            </form>
            {{--<a class ="sell-button" href="{{ route('purchase.create', $product->id) }}">
    購入手続きへ
</a>--}}
        
        
        <h2 class="product-description">商品説明</h2>{{ $product->description }}
        <h2 class="product-">商品の情報</h2>
        <p>カテゴリー{{ $product->categories->pluck('name')->implode(',') }}</p>
        <p>商品の状態{{ $product->condition_name ?? $product->condition }}</p>
        <div class="comments">
            <h2>コメント( {{ $product->comments_count }}) </h2>
            @forelse($product->comments as $c)
            <div class="comment">
                <div class="comment-header">
                    <strong>{{ $c->user->name ?? 'ユーザー' }}</strong>
                    <small>{{ $c->created_at->format('Y/m/d H:i') }}</small>
                </div>
                <div class="comment-body">{{ $c->body }}</div>
            </div>
            @empty
            <p>まだコメントはありません。</p>
            @endforelse
            
            @auth
            <div class="comments__form">
                <p>商品へのコメント</p>
                <form action="{{ route('item.comments.store', $product->id) }}" method="post" class="comment-form">
                    @csrf
                    <textarea name="comment" rows="3" maxlength="255">{{ old('comment') }}</textarea>
                    @error('comment') <div class="form__error">{{ $message }}</div>
                    @enderror
                    <button type="submit">コメントを送信する</button>
                </form>
            </div>
            @else
            <a href="{{ route('login') }}">
                ログインが必要です。
            </a>
            @endauth
        </div>
    </div>
</div>
@endsection