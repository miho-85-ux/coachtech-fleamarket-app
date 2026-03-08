@extends('layout.auth')

@section('css')
<link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endsection

@section('content')
<div class="register-content">
    <div class="register-content__inner">
        <div class="content-title">会員登録</div>
        <form action="/register" method="POST">
            @csrf 
            <div class="content__items">
                <label class="items__title" for="name">ユーザー名</label>
                <input class="items__input" type="text" name="name" id="name" value="{{ old('name') }}">
                @error('name')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>
            <div class="content__items">
                <label class="items__title" for="email">メールアドレス</label>
                <input class="items__input" type="text" name="email" id="email" value="{{ old('email') }}">
                @error('email')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>
            <div class="content__items">
                <label class="items__title" for="password">パスワード</label>
                <input class="items__input" type="password" name="password" id="password">
                @error('password')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>
            <div class="content__items">
                <label class="items__title" for="password_confirmation">確認用パスワード</label>
                <input class="items__input" type="password" name="password_confirmation" id="password_confirmation">
                @error('password_confirmation')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>
            <div class="content__items--submit">
                <button class="register-submit" type="submit">登録する</button>
            </div>
        </form>
        <div class="content__items--login">
            <a class="login" href="/login">ログインはこちら</a>
        </div>

    </div>
</div>
@endsection
