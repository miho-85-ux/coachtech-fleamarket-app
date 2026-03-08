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
                <div class="detail__title">{{ $product->name }}</div>
                <div class="detail__brand">{{ $product->brand }}</div>
                <div class="content-detail__items">
                    <p class="detail__price">￥<span class="detail__price--span">{{ number_format($product->price) }}</span>(税込)</p>
                </div>
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
                        <p class="detail__logo-item--number">{{ $product->comments->count() }}</p>
                    </div>
                    @endauth

                    @guest
                    <a href="/login" class="detail__logo-item" type="submit">
                        <img src="{{ asset('images/ハートロゴ_デフォルト.png') }}" alt="ハートロゴ_デフォルト">
                        <p class="detail__logo-item--number">{{ $product->likes->count() }}</p>
                    </a>
                    <a href="/login" class="detail__logo-item">
                        <img src="{{ asset('images/ふきだしロゴ.png') }}" alt="ふきだしロゴ">
                        <p class="detail__logo-item--number">{{ $product->comments->count() }}</p>
                    </a>
                    @endguest

                </form>
            </div>
            <div class="detail__button">
                <a class="procedure__button" href="/purchase/{{ $product->id }}">購入手続きへ</a>
            </div>
            <div>
                <p class="detail__description">商品説明</p>
                <div class="detail__item">カラー:{{ $product->color }}</div>
                <p class="detail__item">{{ $product->description }}</p>
            </div>
            <div>
                <p class="detail__description">商品の情報</p>
                <div class="detail__category">
                    <p class="detail__item">カテゴリー</p>
                    @foreach ($product->categories as $category)
                    <span class="category">{{ $category->name }}</span>
                    @endforeach
                </div>
                <div class="detail__condition">
                    <p class="detail__item">商品の状態 
                    <p class="detail__condition--product-description">{{ $product->condition }}</p>
                </div>
            </div>
            <div>
                <form action="/products/{{ $product->id }}/comment" method="POST">
                    @csrf 
                    <p class="detail__description">コメント (  {{ $product->comments->count() }}  ) </p>
                    @auth
                    <div>
                        @foreach ($product->comments as $comment)
                        <div class="user__profile">
                            <img class="auth__image" src="{{ asset('storage/' . $comment->user->profile_image) }}" alt="プロフィール画像">
                            <p>{{ $comment->user->name }}</p>
                        </div>
                        <p class="user__comment">{{ $comment->content }}</p>
                        @endforeach
                    </div>
                    <div>
                        <p class="comment__title">商品へのコメント</p>
                        <textarea class="comment__textarea" name="content" cols="100" rows="10"></textarea>
                    </div>
                    @endauth
                    
                    @guest
                    <div>
                        @foreach ($product->comments as $comment)
                        <div class="user__profile">
                            <img class="auth__image"  src="{{ asset('storage/'. $comment->user->profile_image) }}" alt="プロフィール画像">
                            <p>{{ $comment->user->name }}</p>
                        </div>
                        <p class="user__comment">{{ $comment->content }}</p>
                        @endforeach
                    </div>
                    <a class="comment__not-login" href="/login">
                        <p class="comment__title">商品へのコメント</p>
                        <textarea class="comment__textarea" name="content" cols="100" rows="10"></textarea>
                    </a>
                    @endguest
                    
                    @error('content')
                    <p class="error">{{ $message }}</p>
                    @enderror
                    
                    <button class="button__send" type="submit">コメントを送信する</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection