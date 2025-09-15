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
            <form action="{{ route('index') }}" method="GET">
                @csrf
                <input type="text" name="keyword" class="keyword" placeholder="何をお探しですか？">
            </form>
            
            <nav class="header__nav">
                <ul class="heder__list">
                    <li class="header__list-item">
                        <form action="/logout" class="header__form" method="post">
                            @csrf
                            <a href="logout" type="submit">ログアウト</a>
                        </form>
                    </li>
                    <li class="header__list-item">
                        <form action="/?tab=mylist" class="header__form" method="get">
                            @csrf
                            <a href="/?tab=mylist" type="submit">マイページ</a>
                        </form>
                    </li>
                    <li class="header__list-item">
                        <form action="/sell" class="header__form" method="post">
                            @csrf
                            <button class="header__form--listing" type="submit">出品</button>
                        </form>
                    </li>
                </ul>
            </nav>
        </div>
    </header>

    <main>
        @yield('content')
    </main>
</body>

</html>