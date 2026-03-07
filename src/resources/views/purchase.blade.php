@extends('layout.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/purchase.css') }}">
@endsection

@section('content')
<div class="purchase-content">
    <form class="purchase-content__inner" action="/purchase/{{ $product->id }}" method="POST">
        @csrf 
        <div>
            <div class="purchase-content__items--image">
                <div class="content__image">
                    <img src="{{ asset('storage/'. $product->image) }}" alt="{{ $product->name }}">
                </div>
                <div>
                    <p class="content__product-name">{{ $product->name }}</p>
                    <p class="content__product-price">￥{{ $product->price }}</p>
                </div>
            </div>
            <div class="purchase-content__items">
                <p class="content__item">支払方法</p>
                <div class="purchase-items__select">
                    <select class="input__select" name="payment_method" id="payment_method">
                        <option class="select__option" value="" selected disabled>選択してください</option>
                        <option class="select__option" value="1">
                            コンビニ支払い
                        </option>
                        <option class="select__option" value="2">
                            カード支払い
                        </option>
                    </select>
                </div>
                @error('payment_method')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>
            <div class="purchase-content__items">
                <div class="content__delivery">
                    <p class="content__item">配送先</p>
                    <a class="content__item--chenge" href="/purchase/address/{{ $product->id }}">変更する</a>
                </div>
                <div class="content__address">〒{{ $shipping['shipping_postal_code'] ?? $user->postal_code }} 
                    <p>
                        {{ $shipping['shipping_address'] ??  $user->address }}  {{ $shipping['shipping_building'] ?? $user->building }} 
                    </p>
                </div>    
                @error('shipping_postal_code')
                    <p class="error">{{ $message }}</p>
                @enderror
                @error('shipping_address')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>
    
        </div>
        <div>
            <table class="purchase-congtent__table">
                <tr class="table__inner">
                    <th class="table__title">商品代金</th>
                    <td class="table__item">￥{{ $product->price }}</td>
                </tr>
                <tr>
                    <th class="table__title">支払方法</th>
                    <td class="table__item" id="selected_payment">未選択</td>
                </tr>
            </table>
            <div>
                <button class="purchase-button" type="submit">購入手続する</button>
            </div>
        </div>
    </form>
    <script>
        const select = document.getElementById('payment_method');
        const output = document.getElementById('selected_payment');

        select.addEventListener('change', function() {
            const selectedText = select.options[select.selectedIndex].text;
            output.textContent = selectedText;
        });
    </script>
</div>
@endsection