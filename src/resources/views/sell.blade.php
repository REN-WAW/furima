@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/sell.css') }}">
@endsection

@section('content')
<div class="sell__form">
    <div class="sell__form-heading">
        <h2>商品の出品</h2>
    </div>
    
    <form method="POST" action="{{ route('sell.store') }}" enctype="multipart/form-data">
        @csrf
        
        <div class="sell__form-content">
            <label class="label">商品画像</label>
            <div class="sell__product-image">
                <img id="current-image" src="{{ asset('images/') }}">
                <input type="file" name="image_path" id="image" class="form-control-file mt-2" style="display: none;">
                <label for='image' class="button-image">
                    画像を選択する
                </label>
            </div>
            
            <h2 class="product-detail">商品の詳細</h2>
            
            <label class="label">カテゴリー</label>
            <div class="category">
                @foreach($categories as $category)
                <button type="button" class="category-btn" data-id="{{ $category->id }}" name="category-btn">
                    {{ $category->name }}
                </button>
                @endforeach
            </div>

            <label class="label">商品の状態</label>
            <div class="condition">
                <select class="sell__condition" name="condition">
                    <option disabled selected>選択してください</option>
                    <option value="1">良好</option>
                    <option value="2">目立った傷や汚れなし</option>
                    <option value="3">やや傷や汚れあり</option>
                    <option value="4">状態が悪い</option>
                </select>
            </div>

            <h1 class="product-detail">商品名と説明</h1>

            <div class="label">商品名</div>
            <input type="text" name="title" class="text"value="{{ old('title') }}">

            <div class="label">ブランド名</div>
            <input type="text" name="brand" value="{{ old('brand') }}" class="text">

            <div class="label">商品の説明</div>
            <textarea name="description" class="description">{{ old('description') }}</textarea>

            <div class="label">販売価格</div>
            <div class="price-input">
                <span class="yen">¥</span>
                <input type="number" name="price" value="{{ old('price') }}" class="price">
            </div>
        </div>

        <button type="submit" class="sell-button">出品する</button>
    </form>
</div>
@endsection
