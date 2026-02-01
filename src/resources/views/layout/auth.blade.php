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
            </div>
        </div>
    
        <main>
            @yield('content')
        </main>
    </div>
</body>
</html>