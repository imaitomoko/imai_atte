@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/verify-email.css') }}">
@endsection

@section('content')
<div class="verify-email__content">
    <div class="verify-email__heading">
        <h2>メール認証</h2>
    </div>

    <p class="thank">会員登録ありがとうございます。登録されたメールアドレスに確認メールを送っています。メール認証を完了してください。</p>
</div>
@endsection