@extends('layouts.app')
<style>
td {
    padding: 25px 40px;
    text-align: center;
}
svg.w-5.h-5 {
    /*paginateメソッドの矢印の大きさ調整のために追加*/
    width: 30px;
    height: 30px;
}
</style>

@section('css')
<link rel="stylesheet" href="{{ asset('css/userpage.css') }}">
@endsection

@section('content')
<div class="userpage__content">
    <div class="userpage-form__heading">
        <h2>{{ $user->name }}</h2>
    </div>

    <div class="userpage-table">
        <table class="userpage-table__inner">
            <tr class="userpage-table__row">
                <th class="userpage-table__header">勤務日</th>
                <th class="userpage-table__header">勤務開始</th>
                <th class="userpage-table__header">勤務終了</th>
                <th class="userpage-table__header">休憩時間</th>
                <th class="userpage-table__header">勤務時間</th>
            </tr>
           
            <tr class="userpage-table__row">
                <td class="userpage-table__item">サンプル</td>
                <td class="userpage-table__item">サンプル</td>
                <td class="userpage-table__item">サンプル</td>
                <td class="userpage-table__item">サンプル</td>
                <td class="userpage-table__item">サンプル</td>
            </tr>
           
        </table>
       
    </div>
</div>
@endsection