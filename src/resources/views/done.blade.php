@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/done.css') }}">
@endsection

@section('content')
<div class="container">
  <div class="done-container">
    <p class="reserve-done">ご予約ありがとうございます</p>
    <a href="/mypage" class="back-link">戻る</a>
  </div>
</div>

@endsection