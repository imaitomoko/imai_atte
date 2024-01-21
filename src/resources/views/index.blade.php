@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
<div class="index__content">
    <div class="index-form__heading">
        <h2><?php $user = Auth::user(); ?> {{ $user->name }}さんお疲れ様です!</h2>
    </div>
    <div class="button__content">
        <form class="button__item" action="/attendance/start" method="post">
            @csrf
            <button class="attendance__start" type="submit">勤務開始</button>
        </form>
        <form class="button__item" action="/attendance/end" method="post">
        @csrf
        @method('POST')
            <button class="attendance__end" type="submit">勤務終了</button>
        </form>
        <form class="button__item" action="/rest/start" method="post">
        @csrf
        @method('POST')
            <button class="rest__start" type="submit">休憩開始</button>
        </form>
        <form class="button__item" action="/rest/end" method="post">
        @csrf
            <button class="rest__end" type="submit">休憩終了</button>
        </form>
    </div>
</div>
@endsection