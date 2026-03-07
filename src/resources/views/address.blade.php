@extends('layout.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/address.css') }}">
@endsection

@section('content')
<div class="address-content">
    <form class="address-content__inner" action="/purchase/address/{{ $product->id }}" method="POST">
        @csrf
        <input type="hidden" name="id" value="{{ $user->id }}" >
        <div class="address-content__title">住所の変更</div>
        <div>
            <div class="address-content__items">
                <label class="content-item__detail" for="">郵便番号</label>
                <input class="content-item__input" type="text" name="shipping_postal_code" value="{{ old('shipping_postal_code', $user->postal_code) }}">
            </div>
            @error('shipping_postal_code')
                <p class="error">{{ $message }}</p>
            @enderror
            <div class="address-content__items">
                <label class="content-item__detail"  for="">住所</label>
                <input class="content-item__input"  type="text" name="shipping_address" value="{{ old('shipping_address', $user->address) }}">
            </div>
            @error('shipping_address')
                <p class="error">{{ $message }}</p>
            @enderror
            <div class="address-content__items">
                <label class="content-item__detail"  for="">建物名</label>
                <input class="content-item__input"  type="text" name="shipping_building" value="{{ old('shipping_building', $user->building) }}">
            </div>
        </div>
        <div class="address-content__items--button">
            <button class="address-content__button" type="submit">更新する</button>
        </div>
    </form>
</div>

@endsection