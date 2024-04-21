@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/mypage.css') }}">
@endsection


@section('content')
<div class="container">
  <div class="reservation-container">
    <h3>予約状況</h3>
    @foreach ($reservations as $reservation)
    <div class="reserve-info">
      <p>店舗名: {{ $reservation->shop->shop_name }}</p>
      <p>日付: {{ $reservation->date }}</p>
      <p>時間: {{ $reservation->time }}</p>
      <p>人数: {{ $reservation->number }}</p>
      <a href="mypage/edit/{{ $reservation->id }}">予約変更</a>
      <form method="post" action="{{ route('delete') }}">
        @csrf
        <input type="hidden" name="reserve_id" value="{{ $reservation->id }}">
        <div class="delete-button-container">
          <button class="delete-button">×</button>
        </div>
      </form>
    </div>
    @endforeach
  </div>
  <div class="like-container">
    <h2 class="User-name">{{ auth()->user()->name}}さん</h2>
    <h3>お気に入り店舗</h3>
    <div class="shop-container">
      @foreach ($shops as $shop)
      <div class="shop-card">
        <div class="card_img">
          <img src="{{ asset('storage/' . $shop->image) }}" alt="{{ $shop->shop_name }}">
        </div>
        <div class="card_content">
          <div>{{ $shop->shop_name }}</div>
          <div>#{{ $shop->area }}</div>
          <div>#{{ $shop->genre }}</div>
          @if (in_array($shop->id, $like))
          <form method="post" action="{{ route('unlike', $shop->id) }}">
            @csrf
            @method('DELETE')
            <button type="submit" class="unlike-btn">解除</button>
          </form>
          @endif
        </div>
      </div>
      @endforeach
    </div>
  </div>
</div>

@endsection