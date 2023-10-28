@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/stamp.css') }}">
@endsection

@section('title')
<p class="header__logo">Atte</p>
<div class="header__right" >
    <nav class="navigation">
        <ul class="menu__list">
            <li class="menu__item"><a class="menu__itemlink" href="/">ホーム</a></li>
            <li class="menu__item"><a class="menu__itemlink" href="/date">日付一覧</a></li>
            <li class="menu__item">
                <form action="/logout" method="post">
                @csrf
                    <button class="menu__item-button">ログアウト</button>
                </form>
            </li>
        </ul>
    </nav>
</div>
@endsection

@section('content')
<div class="login_title">
    <p>{{ $users['name'] }}さんお疲れ様です！</p>
</div>
<div class="stamp__main" >
    <form action="?" method="post">
    @csrf
        <div class="stamp__form">
            <div class="stamp-form__left">
                <button class="stamp-form__button-submit" type="submit" value="post" formaction="/wstart" {{ $wstarton }} >勤務開始</button>
            </div>
            <div class="stamp-form__right">
                <button class="stamp-form__button-submit" type="submit" value="post" formaction="/wend" {{ $wendon }} >勤務終了</button>
            </div>
        </div>
    </form>
    <form action="?" method="post">
    @csrf
        <div class="stamp__form">
            <div class="stamp-form__left">
                <button class="stamp-form__button-submit" type="submit" value="post" formaction="/bstart" {{ $bstarton }} >休憩開始</button>
            </div>
            <div class="stamp-form__right">
                <button class="stamp-form__button-submit" type="submit" value="post" formaction="/bend" {{ $bendon }} >休憩終了</button>
            </div>
        </div>
    </form>
</div>
@endsection