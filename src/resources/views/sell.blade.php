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
            
            <h2>商品の詳細</h2>
            
            <label class="label">カテゴリー</label>
            <div class="category">
                @foreach($categories as $category)
                <button type="button" class="category-btn" data-id="{{ $category->id }}">
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

            <h2>商品名と説明</h2>

            <label class="label">商品名</label>
            <input type="text" name="title" value="{{ old('title') }}">

            <label class="label">ブランド名</label>
            <input type="text" name="brand" value="{{ old('brand') }}">

            <label class="label">商品の説明</label>
            <textarea name="description">{{ old('description') }}</textarea>

            <label class="label">販売価格</label>
            <div class="price-input">
                <span class="yen">¥</span>
                <input type="number" name="price" value="{{ old('price') }}">
            </div>
        </div>

        <button type="submit">出品する</button>
    </form>
</div>
@endsection
