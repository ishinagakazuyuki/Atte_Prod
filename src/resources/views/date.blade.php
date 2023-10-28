@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/date.css') }}">
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
<div class="date-date">
@foreach ($date as $dates)
{{ $date->links('vendor.pagination.tailwind2') }}
</div>
<div class="date-table">
    <table class="date-table__inner">
        <tr class="date-table__row">
            <th class="date-table__header">
                <span class="date-table__header-item">名前</span>
                <span class="date-table__header-item">勤務開始</span>
                <span class="date-table__header-item">勤務終了</span>
                <span class="date-table__header-item">休憩時間</span>
                <span class="date-table__header-item">勤務時間</span>
            </th>
        </tr>
        @php
            $main1 = $main->where('date', $dates['date'])->paginate(5);
            $breaktime1 = $breaktime->where('date', $dates['date']);
        @endphp
        @foreach ($main1 as $mains)
            @php
                $btime = $breaktime1->where('attendance_id', '=', $mains['id']);
                $tbtimes = new DateTime('00:00:00');
            @endphp
            @foreach ($btime as $btimes)
                @php
                    if(!empty($btimes['break_time'])){
                        $hours = $tbtimes->format('H');
                        $minites = $tbtimes->format('i');
                        $seconds = $tbtimes->format('s');
                        $tbtimes = new DateTime("{$btimes['break_time']} +{$hours} hours +{$minites} min +{$seconds} seconds");
                    }
                @endphp
            @endforeach
        @php
            $tbtimes = $tbtimes->format('H:i:s');
            $wstart = new DateTime($mains['work_start_time']);
            $wstart = $wstart->format('H:i:s');
            if(!empty($mains['work_end_time'])){
                $wend = new DateTime($mains['work_end_time']);
                $wend = $wend->format('H:i:s');
            }else{
                $wend = '';
            }
        @endphp
        <tr class="date-table__row">
            <td class="date-table__item">
                <form class="date-table-form">
                    <div class="date-table-form__item">
                        <input class="date-table-form__item-input" type="text" name="name" value="{{ $mains['name'] }}" readonly/>
                        <input type="hidden" name="id" value="{{ $mains['id'] }}" />
                    </div>
                    <div class="date-table-form__item">
                        <input class="date-table-form__item-input" type="text" name="wstart" value="{{ $wstart }}" readonly/>
                        <input type="hidden" name="id" value="{{ $mains['id'] }}" />
                    </div>
                    <div class="date-table-form__item">
                        <input class="date-table-form__item-input" type="text" name="wend" value="{{ $wend }}" readonly/>
                        <input type="hidden" name="id" value="{{ $mains['id'] }}" />
                    </div>
                    <div class="date-table-form__item">
                        <input class="date-table-form__item-input" type="text" name="btime" value="{{ $tbtimes }}" readonly/>
                        <input type="hidden" name="id" value="{{ $mains['id'] }}" />
                    </div>
                    <div class="date-table-form__item">
                        <input class="date-table-form__item-input" type="text" name="wtime" value="{{ $mains['work_time'] }}" readonly/>
                        <input type="hidden" name="id" value="{{ $mains['id'] }}" />
                    </div>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
    {{ $main1->appends(["date" => \Request::input('date')])->Links('vendor.pagination.tailwind3') }}
</div>
@endforeach
@endsection