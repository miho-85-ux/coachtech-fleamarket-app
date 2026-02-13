@extends('layout.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
<div class="content">
    <div class="content-items">
        <p class="item">
            <a href="/?&name={{ request('name') }}" class="item__mylist {{ request('tab') !== 'mylist' ? 'active' : '' }}" >
                おすすめ
            </a>
        </p>
        <p class="item">
            <a href="/?tab=mylist&name={{ request('name') }}" class="item__mylist {{ request('tab') === 'mylist' ? 'active' : '' }}"  >
                マイリスト
            </a>
        </p>
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
