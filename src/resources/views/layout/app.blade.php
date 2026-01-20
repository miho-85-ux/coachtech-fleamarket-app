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
                    <img src="{{ asset('images/COACHTECHヘッダーロゴ.png') }}" alt="COACHTECHロゴ">
                </div>
                <form action="/" method="GET">
                    <input class="head-input" type="text" name="name" placeholder="なにをお探しですか" value="{{ request('name') }}">
                </form>
                <div class="head-items">
                    <nav>
                        <ul class="nav-lists">
                            <li ><a class="nav-item" href="/login">ログイン</a></li>
                            <li><a class="nav-item" href="/mypage">マイページ</a></li>
                        </ul>
                    </nav>
                    <div>
                        <a class="item-sell"  href="">出品</a>
                    </div>
                </div>
            </div>
        </div>
    
        <main>
            @yield('content')
        </main>
    </div>
</body>
</html>