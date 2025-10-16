@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/item.css') }}">
@endsection

@section('content')
<div class="contents">
    <div class="left-contents">
        <img src="{{ asset(str_replace('storage/app/public/', 'storage', $product->image_path)) }}" alt="{{ $product->title }}" class="img-content" />
    </div>
    
    <div class="right-contents">
        <h2 class="product-title">{{ $product->title }}</h2>
        <p class="product-brand">{{ $product->brand }}</p>
        <h1 class="product-price">¥{{ number_format($product->price) }}
            <label class="tax">（税込）</label>
        </h1>
        <div class="meta">
            @auth
            <form action="{{ route('item.like', $product->id)}}" method="post" style="display:inline;">
                @csrf
                <button type="submit" class="like-button {{ $likedByMe ? 'is-liked' : '' }}">
                    ⭐︎
                </button>
            </form>
            <span class="comment-mark">💬</span>
            @else
            <a href="{{ route('login') }}" class="like-button">
                ⭐︎
            </a>
            <span class="comment-mark">💬</span>
            @endauth
        </div>
        <div class="count">
            <span>{{ $product->likes_count }}</span>
            <span>{{ $product->comments_count }}</span>
        </div>

        <div class="purchase-button">
            <form action="{{ route('purchase' , $product->id )}}"class="purchase__button-form" method="get">
                @csrf
                <button class="purchase__button-label" type="submit">
                    購入手続きへ
                </button>
            </form>
        </div>
        
        <h2 class="product-description">商品説明</h2>
        <a class="description">{{ $product->description }}</a>
        <div class="product__information">
            <h2 class="product__information-title">商品の情報</h2>
            <div class="category">
                <p class="product__category">カテゴリー</p>
                <label class="product__category-tag">
                    {{ $product->categories->pluck('name')->implode(',') }}
                </label>
                <p class="product__condition-title">商品の状態</p>
                <p class ="condition"> {{ $product->condition_label }}</p>
            </div>
        <div class="comments">
            <h2>コメント( {{ $product->comments_count }} ) </h2>
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
                <p class="comments__title">商品へのコメント</p>
                <form action="{{ route('item.comments.store', $product->id) }}" method="post" class="comment-form">
                    @csrf
                    <textarea name="comment" rows="3" maxlength="255" class="comment">{{ old('comment') }}</textarea>
                    @error('comment') <div class="form__error">{{ $message }}</div>
                    @enderror
                    <button class="comments__button" type="submit">コメントを送信する</button>
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