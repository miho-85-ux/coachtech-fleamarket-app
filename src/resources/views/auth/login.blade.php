@extends('layout.auth')

@section('css')
<link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endsection

@section('content')
<div class="login-content">
    <div class="login-content__inner">
        <div class="content-title">ログイン</div>
        <form action="/login" method="POST">
            @csrf 
            <div class="content-items">
                <label for="email">メールアドレス</label>
                <input class="content-items__input" type="text" name="email" id="email" value="{{ old('email') }}">
                @error('email')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>
            <div class="content-items">
                <label for="password">パスワード</label>
                <input class="content-items__input" type="password" name="password" id="password" >
                @error('password')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>
            <div class="login-button">
                <button class="login-button__submit">ログインする</button>
            </div>
        </form>
        <div class="register-button">
            <a class="register-button__submit" href="/register">会員登録はこちら</a>
        </div>
    </div>

</div>
@endsection