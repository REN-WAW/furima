@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/purchase.css') }}">
@endsection

@section('content')
<div class="purchase-form">
    <form method="POST" action="{{ route('purchase.store', $item->id) }}"class="purchase-content">
        @csrf
        <div class="purchase__left-content">
            <div class="purchase__product">
                <img src="{{ asset($item->image_path) }}" alt="{{ $item->title }}" class="img-content" />
                <div class="product__detail">
                    <h2 class="product-title">{{ $item->title }}</h2>
                    <h1 class="product-price">¥{{ number_format($item->price) }}</h1>
                </div>
            </div>
            
            <div class="purchase__payment">
                <h2 class="payment__method-title">支払い方法</h2>
                <select class="payment__method" id="payment-select" name="payment_method" required>
                    <option value="" disabled selected>選択してください</option>
                    <option value="1">コンビニ払い</option>
                    <option value="2">カード支払い</option>
                </select>
                <div class="form__error">
                    @error('payment')
                    {{ $message }}
                    @enderror
                </div>
            </div>
            
            <div class="purchase__address">
                <div class="purchase__address-content">
                    <h2 class="purchase__address-title">配送先</h2>
                    <p class="postcode">〒{{ $user->postcode }}</p>
                    <p class="address">{{ $user->address }} {{ $user->building }}</p>
                </div>
                <label class="address__change">
                    <a href="{{ route('mypage.edit') }}" class="label__change">変更する</a>
                </label>
            </div>
        </div>
        <div class="purchase__right-content">
            <table class="summary-table">
                <tr class="table">
                    <td class="label">商品代金</td>
                    <td class="value">¥{{ number_format($item->price) }}</td>
                </tr>
                <tr class="table">
                    <td class="label">支払い方法</td>
                    <td class="value__payment-display" id="payment-display">未選択</td>
                </tr>
            </table>
            
            <button type="submit" class="purchase-button">購入する</button>
        </div>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function(){
    const paymentSelect = document.getElementById('payment-select');
    const paymentDisplay = document.getElementById('payment-display');
    const paymentOptions = {
        '1': 'コンビニ払い',
        '2': 'カード支払い'
    };
    
    function updatePaymentDisplay() {
        const selectedValue = paymentSelect.value;
        const selectedText = paymentOptions[selectedValue] || '未選択';
        
        if (paymentDisplay) {
            paymentDisplay.textContent = selectedText;
        }
    }
    
    if (paymentSelect) {
        paymentSelect.addEventListener('change', updatePaymentDisplay);
        updatePaymentDisplay();
    }
});
</script>
@endsection
