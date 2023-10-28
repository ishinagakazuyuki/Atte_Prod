@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/list.css') }}">
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
<div class="list-title">
    <span>{{ $user['name'] }}さんの勤務状況</span>
</div>
<div class="list-table">
    <table class="list-table__inner">
        <tr class="list-table__row">
            <th class="list-table__header">
                <span class="list-table__header-item">日付</span>
                <span class="list-table__header-item">勤務開始</span>
                <span class="list-table__header-item">勤務終了</span>
                <span class="list-table__header-item">休憩時間</span>
                <span class="list-table__header-item">勤務時間</span>
            </th>
        </tr>
        @foreach ($main as $mains)
        @php
            $wstart = new DateTime($mains['work_start_time']);
            $wstart = $wstart->format('H:i:s');
            if(!empty($mains['work_end_time'])){
                $wend = new DateTime($mains['work_end_time']);
                $wend = $wend->format('H:i:s');
            }else{
                $wend = '';
            }
            $breaktimes = $breaktime->where('attendance_id', '=', $mains['id']);
            $btimes = new DateTime('00:00:00');
            foreach ($breaktimes as $times) {
                if(!empty($times['break_time'])){
                    $hours = $btimes->format('H');
                    $minites = $btimes->format('i');
                    $seconds = $btimes->format('s');
                    $btimes = new DateTime("{$times['break_time']} +{$hours} hours +{$minites} min +{$seconds} seconds");
                }
            }
            $btimes = $btimes->format('H:i:s');
        @endphp
        <tr class="list-table__row">
            <td class="list-table__item">
                <form class="list-table-form">
                    <div class="list-table-form__item">
                        <input class="list-table-form__item-input" type="text" name="date" value="{{ $mains['date'] }}" readonly/>
                        <input type="hidden" name="id" value="{{ $mains['id'] }}" />
                    </div>
                    <div class="list-table-form__item">
                        <input class="list-table-form__item-input" type="text" name="wstart" value="{{ $wstart }}" readonly/>
                        <input type="hidden" name="id" value="{{ $mains['id'] }}" />
                    </div>
                    <div class="list-table-form__item">
                        <input class="list-table-form__item-input" type="text" name="wend" value="{{ $wend }}" readonly/>
                        <input type="hidden" name="id" value="{{ $mains['id'] }}" />
                    </div>
                    <div class="list-table-form__item">
                        <input class="list-table-form__item-input" type="text" name="btime" value="{{ $btimes }}" readonly/>
                        <input type="hidden" name="id" value="{{ $mains['id'] }}" />
                    </div>
                    <div class="list-table-form__item">
                        <input class="list-table-form__item-input" type="text" name="wtime" value="{{ $mains['work_time'] }}" readonly/>
                        <input type="hidden" name="id" value="{{ $mains['id'] }}" />
                    </div>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
    {{ $main->links('vendor.pagination.tailwind3') }}
</div>
@endsection