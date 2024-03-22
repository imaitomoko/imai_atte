@extends('layouts.app')

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
                <td class="user-table__item">{{ $user->name }}</td>
                <td class="user-table__item">
                    <form action="">
                        <button class="index_button" type="submit">一覧</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </table>
        {{ $users->links() }}
    </div>
</div>

@endsection