<!DOCTYPE html>
<html lang="ja">
<style>
    svg.w-5.h-5 {
    /*paginateメソッドの矢印の大きさ調整のために追加*/
    width: 30px;
    height: 20px;
    }
</style>
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Atte</title>
  <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
  <link rel="stylesheet" href="{{ asset('css/common.css') }}">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous" />
  @yield('css')
</head>
<body>
  <header class="header">
    <div class="header__inner">
    @yield('title')
    </div>
  </header>
  <main>
    <div class="main" >
    @yield('content')
    </div>
  </main>
  <footer  class="copy-right">
    <small>Atte,inc.</small>
  </footer>
</body>
</html>