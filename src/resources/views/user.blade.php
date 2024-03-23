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
<link rel="stylesheet" href="{{ asset('css/user.css') }}">
@endsection

@section('content')
<div class="user__content">
    <div class="user-form__heading">
        <h2>ユーザー一覧</h2>
    </div>

    <div class = "user-table">
        <table class="user-table__inner">
            <tr class="user-table__row">
                <th class="user-table__header">名前</th>
                <th class="user-table__header">勤怠表</th>
            </tr>
            @foreach($users as $user)
            <tr class="user-table__row">
                <form action="">
                    <td class="user-table__item">{{ $user->name }}</td>
                    <td class="user-table__item">
                        <button class="index_button" type="submit">一覧</button>
                    </td>
                </form>
            </tr>
            @endforeach
        </table>
        <div class="paginate">
            {{ $users->links() }}
        </div>
    </div>
</div>

@endsection