<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fleamarket</title>
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    @yield('css')
</head>
<body>
    <div class="content">
        <div class="head">
            <div class="head-row">
                <div>
                    <a href="/">
                        <img src="{{ asset('images/COACHTECHヘッダーロゴ.png') }}" alt="COACHTECHロゴ">
                    </a>
                </div>
                <form action="/" method="GET">
                    <input class="head-input" type="text" name="name" placeholder="なにをお探しですか？" value="{{ request('name') }}">
                    <input type="hidden" name="tab" value="{{ request('tab') }}">
                </form>
                <div class="head-items">
                    <nav>
                        <ul class="nav-lists">                            
                            @if (Auth::check())
                            <form action="/logout" method="POST">
                                @csrf
                                <button class="nav-item__logout" type="submit">ログアウト</button>    
                            </form>
                            @else
                            <li ><a class="nav-item" href="/login">ログイン</a></li>
                            @endif
                            <li><a class="nav-item" href="/mypage">マイページ</a></li>
                            <li><a class="item-sell" href="/sell">出品</a></li>                          
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    
        <main>
            @yield('content')
        </main>
    </div>
</body>
</html>