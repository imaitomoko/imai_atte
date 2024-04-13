@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/verify-email.css') }}">
@endsection

@section('content')
<div class="verify-email__content">
    <div class="verify-email__heading">
        <h2>メール認証</h2>
    </div>

    <div class="card-body">
        @if (session('resent'))
            <div class="alert alert-success" role="alert">
                {{ __('ご登録いただいたメールアドレスに確認用のリンクをお送りしました。') }}
            </div>
        @endif
            {{ __('メールをご確認ください。') }}
            {{ __('もし確認用メールが送信されていない場合は、下記をクリックしてください。') }},
            <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                @csrf
                <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('確認メールを再送信する') }}</button>.
            </form>
    </div>
</div>
@endsection