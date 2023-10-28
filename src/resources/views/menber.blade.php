@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/menber.css') }}">
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
<div class="menber-title">
    <span>ユーザー一覧</span>
</div>
<div class="menber-table">
    <table class="menber-table__inner">
        <tr class="menber-table__row">
            <th class="menber-table__header">
                <span class="menber-table__header-item">名前</span>
                <span class="menber-table__header-item">メールアドレス</span>
            </th>
        </tr>
        @foreach ($user as $users)
        <tr class="menber-table__row">
            <td class="menber-table__item">
                <form class="menber-table-form" action="/list" method="post">
                    @csrf
                    <div class="menber-table-form__item">
                        <button class="menber-table-form__item-input" type="submit">{{ $users['name'] }}</button>
                        <input type="hidden" name="id" value="{{ $users['id'] }}" />
                    </div>
                    <div class="menber-table-form__item">
                        <input class="menber-table-form__item-input" type="text" name="wstart" value="{{ $users['email'] }}" readonly/>
                        <input type="hidden" name="id" value="{{ $users['id'] }}" />
                    </div>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
    {{ $user->links('vendor.pagination.tailwind3') }}
</div>
@endsection