@extends('layout.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')

@if(session('message'))
<div class="alert-success">
    {{ session('message')}}
</div>
@endif
@if(session('purchase_success'))
<div class="alert-success__purchase">
    {{ session('purchase_success')}}
</div>
@endif


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
            @if($product->order)
                <span class="sold-label">sold</span>
            @endif
        </a>
        @endforeach
    </div>
</div>
@endsection
