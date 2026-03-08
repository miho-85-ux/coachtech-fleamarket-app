@extends('layout.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/sell.css') }}">
@endsection

@section('content')
<div class="sell-content">
    <div class="sell-content__inner">
        <form action="/sell" method="POST" enctype="multipart/form-data">
            @csrf 
            <div class="sell-content__title">商品の出品</div>
            <div>
                <p class="sell-content__image-title">商品画像</p>
                <div class="content-image__button">
                    <img id="preview" src="" alt="">
                    <label class="image__select">
                        画像を選択する
                        <input type="file" name="image" hidden onchange="previewImage(this)" >
                    </label>
                    @error('image')
                    <p class="error">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <p class="sell-content__detail">商品の詳細</p>
                    <div>
                        <p class="detail-item">カテゴリー</p>
                        <div class="detail__category">
                            @foreach ($categories as $category)
                            <input type="checkbox" name="categories[]" value="{{ $category->id }}" 
                            {{ in_array(($category->id), old('categories', [])) ? 'checked' : '' }} 
                            id="category{{ $category->id }}" class="category-checkbox"  hidden >
                            <label class="category-button" for="category{{ $category->id }}">
                                {{ $category -> name }}
                            </label>
                            @endforeach
                        </div>
                        @error('categories')
                        <p class="error">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="detail-items">
                        <label class="detail-item">商品の状態</label>
                        <div class="detail-items__select">
                            <select class="input__select" name="condition" >
                                <option class="input__select--option" value="" selected disabled >選択してください</option>
                                <option class="input__select--option" value="良好" {{ old('condition') == '良好' ? 'selected' : '' }}>良好</option>
                                <option class="input__select--option"value="目立った傷や汚れなし" {{ old('condition') == '目立った傷や汚れなし' ? 'selected' : '' }}>目立った傷や汚れなし</option>
                                <option class="input__select--option"value="やや傷や汚れあり" {{ old('condition') == 'やや傷や汚れあり' ? 'selected' : '' }}>やや傷や汚れあり</option>
                                <option class="input__select--option"value="状態が悪い" {{ old('condition') == '状態が悪い' ? 'selected' : '' }}>状態が悪い</option>
                            </select>
                        </div>
                    </div>                    
                    @error('condition')
                    <p class="error">{{ $message }}</p>
                    @enderror
                    <div>
                        <p class="sell-content__detail">商品名と説明</p>
                        <div class="detail-items">
                            <label class="detail-item" for="name">商品名</label>
                            <input class="input"  type="text" name="name" id="name" value="{{ old('name') }}">
                        </div>
                        @error('name')
                        <p class="error">{{ $message }}</p>
                        @enderror
                        <div class="detail-items">
                            <label class="detail-item" for="brand">ブランド名</label>
                            <input class="input"  type="text" name="brand" id="brand" value="{{ old('brand') }}">
                        </div>
                        <div class="detail-items">
                            <label class="detail-item" for="description">商品の説明</label>
                            <textarea  class="textarea" name="description" id="description">{{ old('description') }}</textarea>
                        </div>
                        @error('description')
                        <p class="error">{{ $message }}</p>
                        @enderror
                        <div class="detail-items">
                            <label class="detail-item" for="price">販売価格</label>
                            <div class="detail-item__price">
                                <span>￥</span>
                                <input class="input"  type="text" name="price" id="price" value="{{ old('price') }}" oninput="formatPrice(this)">
                            </div>
                        </div>
                        @error('price')
                        <p class="error">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div>
                    <button class="sell-button" type="submit">出品する</button>
                </div>
            </div>
        </form>
        <script>
            function previewImage(input) {
                const preview = document.getElementById('preview');

                if (input.files && input.files[0]) {
                    const reader = new FileReader();

                    reader.onload = function (e) {
                        preview.src = e.target.result;
                    }

                    reader.readAsDataURL(input.files[0]);
                }
            }
        </script>
        <script>
            function formatPrice(input) {
                let value = input.value.replace(/[^0-9]/g, '');
                input.value = value.replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,');
            }
        </script>
    </div>
</div>
@endsection
