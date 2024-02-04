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
<link rel="stylesheet" href="{{ asset('css/datetable.css') }}">
@endsection

@section('content')
<div class="datetable__content">
    <div class="datetable-form__heading">
        <form action="/attendance" method="get">
            @csrf
            <input type="text" name="date" value="<?php echo date('Y-m-d');?>" />
            <button type="submit">検索</button>
        </form>
    </div>

    <div class="attendance-table">
        <table class="attendance-table__inner">
            <tr class="attendance-table__row">
                <th class="attendance-table__header">名前</th>
                <th class="attendance-table__header">勤務開始</th>
                <th class="attendance-table__header">勤務終了</th>
                <th class="attendance-table__header">休憩時間</th>
                <th class="attendance-table__header">勤務時間</th>
            </tr>
            @foreach($items as $item)
            <tr class="attendance-table__row">
                <td class="attendance-table__item">{{ $item->user->name }}</td>
                <td class="attendance-table__item">{{ $item->start_work }}</td>
                <td class="attendance-table__item">{{ $item->end_work }}</td>
                <td class="attendance-table__item">サンプル</td>
                <td class="attendance-table__item">サンプル</td>
            </tr>
            @endforeach
        </table>
        {{ $items->links() }}
    </div>
</div>
@endsection