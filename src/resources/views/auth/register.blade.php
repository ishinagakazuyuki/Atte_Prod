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
    <p>会員登録</p>
</div>
<div class="login__content">
    <form class="login-form" action="/register" method="post">
    @csrf
        <div class="login-form__item">
            <input class="login-form__input" type="text" name="name" placeholder="　名前" value="{{ old('name') }}"  >
        </div>
        <div class="login-form__item">
            <input class="login-form__input" type="text" name="email" placeholder="　メールアドレス" value="{{ old('email') }}" >
        </div>
        <div class="login-form__item">
            <input class="login-form__input" type="password" name="password" placeholder="　パスワード" >
        </div>
        <div class="login-form__item">
            <input class="login-form__input" type="password" name="password_confirmation" placeholder="　確認用パスワード" >
        </div>
        <div class="login-form__item">
            <button class="login-form__button-submit" type="submit">会員登録</button>
        </div>
    </form>
    <div>
        <span class=login-guidance>アカウントをお持ちの方はこちらから</span><br>
        <a href="/login" class=login-guidance__link>ログイン</a>
    </div>
</div>

@endsection