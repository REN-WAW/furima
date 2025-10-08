<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>coachtechフリマ</title>
    <link rel="stylesheet" href="{{asset('css/sanitize.css')}}">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    @yield('css')
</head>

<body>
    <header class="header">
        <div class="header__inner">
            <h1 class="header__logo">
                <img src="{{ asset('/images/logo.svg') }}" alt="ロゴ" class="img-header-logo" />
            </h1>
            @yield('logo')
            
            <div class="header__search">
                @if (Auth::check())
                <form action="{{ route('index') }}" method="GET">
                    <input type="text" name="keyword" class="keyword" placeholder="なにをお探しですか？">
                </form>
                @endif
            </div>

            <div class="header__nav">
                @if(Auth::check())
                <ul class="heder__list">
                    <li class="header__list-item">
                        <a href="{{ route('logout') }}"onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            ログアウト
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="post" class="hidden-form">
                            @csrf
                        </form>
                    </li>
                    
                    <li class="header__list-item">
                        <form action="/?tab=mylist" class="header__form" method="get">
                            <a href="/mypage" type="submit">マイページ</a>
                        </form>
                    </li>
                    <li class="header__list-item">
                        <form action="/sell" class="header__form" method="get">
                            <button class="header__form-listing" type="submit">出品</button>
                        </form>
                    </li>
                </ul>
                @endif
            </div>
        </div>
    </header>

    <main>
        @yield('content')
    </main>
</body>

</html>