@extends('layout.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/mypage.css') }}">
@endsection

@section('content')
<div class="mypage-content">
    <div class="content-inner">
        <div class="content__profile">
            <img class="profile-image" src="{{ asset('storage/' . auth()->user()->profile_image) }}" alt="プロフィール画像">
            <input class="profile-name" type="text" name="name" value="{{ auth()->user()->name }}">
            <a class="profile-button" href="/mypage/profile">プロフィールを編集</a>
        </div>
        <div class="content__select">
            <a class="content__left-select {{ $page === 'sell' ? 'active' : '' }}" href="/mypage?page=sell" >出品した商品</a>
            <a class="content__right-select {{ $page === 'buy' ? 'active' : '' }}" href="/mypage?page=buy">購入した商品</a>
        </div>
    </div>
    <div>
        <div class="content-card">
            @if($page === 'sell')
                @foreach ($products as $product)
                <a class="card" href="/item/{{ $product->id }}">
                    <div class="card__inner">
                        <img class="card-img" src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
                        <p class="card-name">{{ $product->name }}</p>
                    </div>
                </a>
                @endforeach
            @else
                @foreach($orders as $order)
                <a class="card" href="/item/{{ $order->product->id }}">
                    <div class="card__inner">
                        <img class="card-img" src="{{ asset('storage/' . $order->product->image) }}" alt="{{ $order->product->name }}">
                        <p class="card-name"> {{ $order->product->name }}</p>
                    </div>
                </a>
                @endforeach
            @endif
        </div>
           
    </div>
</div>
@endsection