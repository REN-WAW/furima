@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/setup.css') }}">
@endsection

@section('content')
<div class="profile__setup-content">
  <div class="profile__setup-heading">
    <h2>プロフィール設定</h2>
  </div>

  @if($firstTime)
  @endif
  <form method="POST" action="{{ route('mypage.update') }}" enctype="multipart/form-data" class="form" novalidate>
    @csrf
    
    <div class="form__profile">
      <div class="form__icon-image">
        <img id="current-image" src="{{ $user->icon_image ? asset($user->icon_image) : asset('images/placeholder-user.png') }}" class="icon_image">
        <input type="file" name="image" id="image" class="form-control-file mt-2" style="display: none;">
        <label for='image' class="button-image">
          画像を選択
        </label>
        <div class="form__error">
        @error('icon_image')
        {{ $message}}
        @enderror
        </div>
      </div>
      
      <div class="form__group-profile">
        <span class="form__label-item">ユーザー名</span>
        <div class="form__group-content">
          <div class="form__input-text">
            <input type="text" name="name" class="input" value="{{ old('name', $user->name) }}" />
          </div>
          <div class="form__error">
            @error('name')
            {{ $message }}
            @enderror
          </div>
        </div>
      </div>
      
      <div class="form__group-profile">
        <span class="form__label--item">郵便番号</span>
      </div>
      <div class="form__group-content">
        <div class="form__input--text">
          <input type="text" name="postcode" class="input" value="{{ old('postcode', $user->postcode) }}" />
        </div>
        <div class="form__error">
          @error('postcode')
          {{ $message }}
          @enderror
        </div>
      </div>

      <div class="form__group-profile">
        <span class="form__label--item">住所</span>
      </div>
      <div class="form__group-content">
        <div class="form__input--text">
          <input type="text" name="address" class="input" value="{{ old('address',$user->address) }}" />
        </div>
        <div class="form__error">
          @error('address')
          {{ $message }}
          @enderror
        </div>
      </div>

      <div class="form__group-profile">
        <span class="form__label--item">建物名</span>
      </div>
      <div class="form__group-content">
        <div class="form__input--text">
          <input type="text" name="building" class="input" value="{{ old('building', $user->building) }}" />
        </div>
        <div class="form__error">
          @error('building')
          {{ $message }}
          @enderror
        </div>
      </div>

      <div class="form__button">
        <button class="form__button-submit" type="submit">更新する</button>
      </div>
    </div>
  </form>
</div>
@endsection