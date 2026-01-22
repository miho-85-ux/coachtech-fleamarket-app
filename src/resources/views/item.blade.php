@extends('layout.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/item.css') }}">
@endsection

@section('content')
<div class="item-content">
    <div class="item-content__inner">
        <div class="content-image">
            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
        </div>
        <div class="content-detail">
            <div>
                <input class="detail__input--title" type="name" name="name" value="{{ $product->name }}">
                <input class="detail__input--brand"  type="text" name="brand" value="{{ $product->brand }}">
                <p>￥<input class="detail__input--price" type="text" name="price" value="{{ $product->price }}" >（税込）</p>
                <div class="detail__logo">
                    <div class="detail__logo-item">
                        <img src="{{ asset('images/ハートロゴ_デフォルト.png') }}" alt="ハートロゴ_デフォルト">
                        <p class="detail__logo-item--number">8</p>
                    </div>
                    <div class="detail__logo-item">
                        <img src="{{ asset('images/ふきだしロゴ.png') }}" alt="ふきだしロゴ">
                        <p class="detail__logo-item--number">10</p>
                    </div>
                </div>
            </div>
            <div class="detail__button">
                <a class="procedure__button"href="">購入手続きへ</a>
            </div>
            <div>
                <p class="detail__description">商品説明</p>
                <label class="detail__item">カラー:<input class="detail__input" type="text" name="color" value="{{ $product->color }}"></label>
                <p>
                    <input class="detail__input" type="text" name="description" value="{{ $product->description }}">
                </p>
            </div>
            <div>
                <p class="detail__description">商品の情報</p>
                <p class="detail__item">カテゴリー<input class="detail__input" type="text" name="" valie=""></p>
                <p class="detail__item">商品の状態 <input class="detail__input" tupe="text" name="condition" value="{{ $product->condition }}"></p>
            </div>
            <div>
                <form action="">
                    <p class="detail__description">コメント</p>
                    <textarea name="" id="" cols="100" rows="10"></textarea>
                    <button class="button__send" type="submit" name="">コメントを送信する</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection