@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/userpage.css') }}">
@endsection

@section('content')
<div class="userpage__content">
    <div class="userpage-form__heading">
        <h2>{{ $user ->name ?? '' }}</h2>
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
            @foreach($items ?? [] as $item)
            <tr class="userpage-table__row">
                <td class="userpage-table__item">{{ $item->work_date ?? '' }}</td>
                <td class="userpage-table__item">{{ $item->start_work ?? '' }}</td>
                <td class="userpage-table__item">{{ $item->end_work ?? '' }}</td>
                <td class="userpage-table__item">{{ $item->total_break_duration ?? '' }}</td>
                <td class="userpage-table__item">{{ $item->result ?? '' }}</td>
            </tr>
            @endforeach
        </table>
        <div class="paginate">
            {{ $items->links() ?? '' }}
        </div>
    </div>
</div>
@endsection