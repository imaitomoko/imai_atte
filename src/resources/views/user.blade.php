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
                        <a class="index_button" href="/user/userpage?name={{ urlencode($user->name) }}">一覧</a>
                    </td>
            </tr>
            @endforeach
        </table>
         <div class="paginate">
            {{ $users->links() }}
        </div>
    </div>
</div>

@endsection