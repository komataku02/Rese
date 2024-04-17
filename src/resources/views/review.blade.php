@extends('layouts.app')

@section('content')
@if(auth()->check())
<div class="back-btn">
  <a href="{{ route('show.detail', ['shop_id' => $shop->id]) }}">
    back</a>
</div>
<form action="{{ route('submitReview', ['shop_id' => $shop->id ,'reserve_id' => $reservation->id]) }}" method="post">
  @csrf
  <label for="stars">評価：</label>
  <select name="stars" id="stars">
    <option value="1">1</option>
    <option value="2">2</option>
    <option value="3">3</option>
    <option value="4">4</option>
    <option value="5">5</option>
  </select>
  <br>
  <label for="comment">コメント：</label>
  <textarea name="comment" id="comment" rows="3"></textarea>
  <br>
  <button type="submit">評価する</button>
</form>
@endif
@endsection