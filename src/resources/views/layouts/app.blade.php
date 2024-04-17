<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Rese</title>
  <link rel="stylesheet" href="{{ asset('css/reset.css') }}" />
  <link rel="stylesheet" href="{{ asset('css/common.css') }}" />
  @yield('css')
</head>

<body>
  <header class="header">
    <div class="header__inner">
      <nav id="nav">
        <ul class="header-nav-list">
          <li class="header-nav-item"><a class="header-nav-item-link" href="/">Home</a></li>
          @if (Auth::check())
          <li class="header-nav-item">
            <form action="/logout" method="post">
              @csrf
              <button class="header-nav-item-button">logout</button>
            </form>
          </li>
          <li class="header-nav-item"><a class="header-nav-item-link" href="/mypage">Mypage</a></li>
          <li class="header-nav-item"><a class="header-nav-item-link" href="/admin/create_shop_owner">Admin</a></li>
          <li class="header-nav-item"><a class="header-nav-item-link" href="/admin/create_shop">ShopOwner</a></li>
          @else
          <li class="header-nav-item"><a class="header-nav-item-link" href="/register">Register</a></li>
          <li class="header-nav-item"><a class="header-nav-item-link" href="/login">Login</a></li>
          @endif
        </ul>
      </nav>
      <div id="hamburger">
        <span class="inner_line" id="line1"></span>
        <span class="inner_line" id="line2"></span>
        <span class="inner_line" id="line3"></span>
      </div>

      <style>
      </style>

      <script>
        function hamburger() {
          document.getElementById('line1').classList.toggle('line_1');
          document.getElementById('line2').classList.toggle('line_2');
          document.getElementById('line3').classList.toggle('line_3');
          document.getElementById('nav').classList.toggle('in');
        };
        document.getElementById('hamburger').addEventListener('click', function() {
          hamburger();
        });
      </script>
      <h1 class="header-tittle"><a class="header-tittle-link" href="/">Rese</a></h1>
    </div>
  </header>

  <main>
    @yield('content')
  </main>
</body>

</html>