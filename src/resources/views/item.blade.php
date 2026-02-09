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
                <form class="detail__logo" action="/products/{{ $product->id }}/like" method="POST">
                    @csrf 
                    @auth
                    <button class="detail__logo-item" type="submit">
                        @if ($product->likes->where('user_id', auth()->id())->count())
                        <img src="{{ asset('images/ハートロゴ_ピンク.png') }}" alt="ハートロゴ_ピンク">
                        @else
                        <img src="{{ asset('images/ハートロゴ_デフォルト.png') }}" alt="ハートロゴ_デフォルト">
                        @endif
                        <p class="detail__logo-item--number">{{ $product->likes->count() }}</p>
                    </button>
                    <div class="detail__logo-item">
                        <img src="{{ asset('images/ふきだしロゴ.png') }}" alt="ふきだしロゴ">
                        <p class="detail__logo-item--number">{{ $product->likes->count() }}</p>
                    </div>
                    @endauth

                    @guest
                    <a href="/login" class="detail__logo-item" type="submit">
                        <img src="{{ asset('images/ハートロゴ_デフォルト.png') }}" alt="ハートロゴ_デフォルト">
                        <p class="detail__logo-item--number">{{ $product->likes->count() }}</p>
                    </a>
                    <a href="/login" class="detail__logo-item">
                        <img src="{{ asset('images/ふきだしロゴ.png') }}" alt="ふきだしロゴ">
                        <p class="detail__logo-item--number">{{ $product->likes->count() }}</p>
                    </a>
                    @endguest

                </form>
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
                @auth
                <form action="">
                    <p class="detail__description">コメント</p>
                    <div>
                        <img class="auth__image" src="{{ asset('storage/' . auth()->user()->profile_image) }}" alt="プロフィール画像">
                        <input class="auth__input" type="text" name="name" value="{{ auth()->user()->name }}">
                        <div>
                            <input type="text" name="" value="">
                        </div>
                    </div>
                    <div>
                        <p class="comment__title">商品へのコメント</p>
                        <textarea class="comment__textarea" name="" id="" cols="100" rows="10"></textarea>
                        <button class="button__send" type="submit" name="">コメントを送信する</button>
                    </div>
                </form>
                @endauth
                @guest

                @endguest
            </div>
        </div>
    </div>
</div>
@endsection