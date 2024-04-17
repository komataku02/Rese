@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/details.css') }}">
@endsection

@section('content')
<div class='container'>
  <div class="shop_info-container">
    <div class="back-btn">
      <a href="/">back</a>
    </div>
    <div class="shop_name">
      <h2>{{ $data->shop_name }}</h2>
    </div>
    <div class="shop_img">
      <img>画像リンク
    </div>
    <div class="tag_form">
      <div class="area_tag">#{{ $data->area }}</div>
      <div class="genre_tag">#{{ $data->genre }}</div>
    </div>
    <div class="overview_form">
      <p class="shop_overview">{{ $data->overview }}</p>
    </div>
  </div>
  @if (Auth::check())
  <div class="reserve_container">
    <h2 class="reservation">予約</h2>
    <div class="reserve_form">
      <form method="post" action="{{ route('create',$data->id) }}">
        @csrf
        <input type="date" name="date" id="date" required><br>
        <select name="time" id="time" required>
          <option value=""></option>
          <option value="9:00">9:00</option>
          <option value="10:00">10:00</option>
          <option value="11:00">11:00</option>
          <option value="12:00">12:00</option>
          <option value="13:00">13:00</option>
          <option value="14:00">14:00</option>
          <option value="15:00">15:00</option>
          <option value="16:00">16:00</option>
          <option value="17:00">17:00</option>
          <option value="18:00">18:00</option>
          <option value="19:00">19:00</option>
          <option value="20:00">20:00</option>
          <option value="21:00">21:00</option>
          <option value="22:00">22:00</option>
          <option value="23:00">23:00</option>
        </select><br>
        <select name="number" id="number" required>
          <option value=""></option>
          <option value="1人">1人</option>
          <option value="2人">2人</option>
          <option value="3人">3人</option>
          <option value="4人">4人</option>
          <option value="5人">5人</option>
          <option value="6人">6人</option>
          <option value="7人">7人</option>
          <option value="8人">8人</option>
          <option value="9人">9人</option>
          <option value="10人">10人</option>
        </select>
        <div class="reserve_info-container">
          @if ($reservations)
          @if ($reservations->isNotEmpty())
          <ul>
            <div>
              <p>店舗名: {{ $data->shop_name }}</p>
            </div>
            @foreach ($reservations as $reservation)
            <li>
              <p>日付: {{ $reservation->date }}</p>
              <p>時間: {{ $reservation->time }}</p>
              <p>人数: {{ $reservation->number }}</p>
              @php
              $reservationDateTime = Carbon\Carbon::parse($reservation->date . ' ' . $reservation->time);
              @endphp
              @if ($reservationDateTime ->isPast()) <a href="{{ route('showReview', ['shop_id' => $data->id, 'reserve_id' => $reservation->id]) }}">レビューを書く</a>
                @endif
            </li>
            @endforeach
          </ul>
          @else
          <p>予約情報はありません。</p>
          @endif
          @else
          <p>予約情報はありません。</p>
          @endif
        </div>
        <input type="submit" class="reserve-btn" value="予約する">
      </form>
    </div>
  </div>
  @endif
</div>
@endsection