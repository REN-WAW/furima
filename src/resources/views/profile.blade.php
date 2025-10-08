@extends('layouts/app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/profile.css') }}">
@endsection

@section('content')
<div class="profile__form-content">
    <div class="profile__form-heading">
        <div class="form__icon-image">
            <img src="{{ $user->icon_image ? asset($user->icon_image) : asset('storage/icons/default.png') }}" class="icon">
        </div>
        <h2 class="profile__name">
            {{ $user->name }}
        </h2>
        <div class="profile__setup-button">
            <a href="{{ route('mypage.edit') }}" class="button">
                プロフィールを編集
            </a>
        </div>
    </div>
    
    <nav class="product__content-nav">
        <ul class="product__content-list">
            <li class="product__content-mylist">
                <a href="{{ route('mypage.show',['tab' => 'listed']) }}" class="{{ ($activeTab === 'listed') ? 'active' : '' }}">
                    出品した商品
                </a>
            </li>
            <li class="heading__content-mylist">
                <a href="{{ route('mypage.show', ['tab' => 'purchased']) }}" class="{{ ($activeTab ?? 'purchased') === 'purchased' ? 'active' : '' }}">
                    購入した商品
                </a>
            </li>
        </ul>
    </nav>
    
    <div class="product-contents">
        @forelse ($products as $product)
        <div class="product-content">
            <a href="{{ route('item.show', ['item_id' => $product->id]) }}" class="product-link">
                <img src="{{asset(str_replace('storage/app/public/', 'storage/', $product->image_path)) }}" alt="{{ $product->title }}" class="img-content"/>
                {{-- <img src="{{ asset(str_replace('storage/app/public/', 'storage/', $product->image_path)) }}" alt="{{ $product->title }}" class="img-content" /> --}}
            <div class="detail-content">
                <p class="product-title">
                    {{ $product->title }}
                </p>
            </div>
        </a>
    </div>
    @endforeach
</div>

@endsection