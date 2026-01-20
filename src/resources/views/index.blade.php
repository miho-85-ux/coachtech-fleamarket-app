@extends('layout.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
<div class="content">
    <div class="content-items">
        <p class="item"><a class="item__mylist" href="/">おすすめ</a></p>
        <p class="item"><a class="item__mylist" href="">マイリスト</a></p>
    </div>
    <div class="card-items">
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
