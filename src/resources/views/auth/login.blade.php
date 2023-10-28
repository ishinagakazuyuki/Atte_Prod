@extends('layouts.app')

@section('title')
<p class="header__logo">
    Atte
</p>

@endsection

@section('content')
<div class="todo__alert">
    @if(session('message'))
    <div class="todo__alert--success">
        {{session('message')}}
    </div>
    @endif
    @if ($errors->any())
    <div  class="todo__alert--danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
</div>

<div class="login_title">
    <p>ログイン</p>
</div>
<div class="login__content">
    <form class="login-form" action="/login" method="post">
    @csrf
        <div class="login-form__item">
            <input class="login-form__input" type="text" name="email" placeholder="　メールアドレス" value="{{ old('email') }}" >
        </div>
        <div class="login-form__item">
            <input class="login-form__input" type="password" name="password" placeholder="　パスワード" >
        </div>
        <div class="login-form__item">
            <button class="login-form__button-submit" type="submit">ログイン</button>
        </div>
    </form>
    <div>
        <span class=login-guidance>アカウントをお持ちでない方はこちらから</span><br>
        <a href="/register" class=login-guidance__link>会員登録</a>
    </div>
</div>

@endsection