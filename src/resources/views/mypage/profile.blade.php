@extends('layout.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/profile.css') }}">
@endsection

@section('content')
<div class="profile-content">
    <div class="profile-content__inner">
        <div class="content-title">プロフィール設定</div>
        <form class="content-form" action="/mypage/profile" method="POST" enctype="multipart/form-data">
            @csrf 
            <div class="content-image">
                <img  id="preview" src="{{ auth()->user()->profile_image ? asset('storage/' . auth()->user()->profile_image) : asset('images/default.jpg') }}" alt="プロフィール画面">
                <label class="content-image__button">
                    画像を選択する
                    <input type="file" name="profile_image" hidden onchange="previewImage(this)" >
                </label>
            </div>
            <div class="content-items">
                <label for="name">ユーザー名</label>
                <input class="content-items__input" type="text" name="name" id="name" value="{{ auth()->user()->name }}">
            </div>
            <div class="content-items">
                <label for="postal_code">郵便番号</label>
                <input class="content-items__input" type="text" name="postal_code" id="postal_code" value="{{ auth()->user()->postal_code }}">
            </div>
            <div class="content-items">
                <label for="address">住所</label>
                <input class="content-items__input" type="text" name="address" id="address" value="{{ auth()->user()->address }}">
            </div>
            <div class="content-items">
                <label for="building">建物名</label>
                <input class="content-items__input" type="text" name="building" id="building" value="{{ auth()->user()->building }}">
            </div>
            <div>
                <button class="content-items__button"  type="submit">更新する</button>
            </div>
        </form>
        <script>
            function previewImage(input) {
                if (input.files && input.files[0]) {
                    const reader = new FileReader();

                    reader.onload = function (e) {
                        document.getElementById('preview').src = e.target.result;
                    };

                    reader.readAsDataURL(input.files[0]);
                }
            }
        </script>
    </div>
</div>
@endsection