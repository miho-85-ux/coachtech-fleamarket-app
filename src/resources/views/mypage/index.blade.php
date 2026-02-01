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
            <div class="content__left-select">出品した商品</div>
            <div >購入した商品</div>
        </div>
    </div>
    <div class="content-card">
        @foreach ($products as $product)
        <a class="card" href="/item/{{ $product->id }}">
            <div class="card__inner">
                <img class="card-img" src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
            </div>
            <p class="card-name">{{ $product->name }}</p>
        </a>
        @endforeach
    </div>
</div>
@endsection