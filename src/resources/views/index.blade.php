@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('link')
<form action="/logout" method="post">
    @csrf
    <input class="header__link" type="submit" value="logout">
</form>
@endsection

@section('content')
<nav class="heading__content">
    <ul class="heading__content-list">
        <li class="heading__content-recommend">
            <a href="{{ route('index') }}" class="{{ $activeTab === 'all' ? 'active' : '' }}">
                おすすめ
            </a>
        </li>
        <li class="heading__content-mylist">
            <a href="{{ route('index', ['tab' => 'mylist']) }}" class="{{ $activeTab === 'mylist' ? 'active' : '' }}">
                マイリスト
            </a>
        </li>
    </ul>
</nav>

<div class="product-contents">
    @foreach ($products as $product)
    <div class="product-content">
        <a href="{{ route('item.show', $product->id) }}" class="product-link">
            <img src="{{ asset(str_replace('storage/app/public/', 'storage/', $product->image_path)) }}" alt="{{ $product->title }}" class="img-content" />
            <div class="detail-content">
                <p>{{ $product->title }}</p>
            </div>
        </a>
    </div>
    @endforeach
</div>

@endsection
