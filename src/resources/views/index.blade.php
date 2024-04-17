@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
<div class="search_container">
  <form method="GET" action="{{ route('search') }}">
    <select name="area">
      <option value="">エリアを選択</option>
      <option value="東京都">東京都</option>
      <option value="大阪府">大阪府</option>
      <option value="福岡県">福岡県</option>
    </select>
    <select name="genre">
      <option value="">ジャンルを選択</option>
      <option value="イタリアン">イタリアン</option>
      <option value="寿司">寿司</option>
      <option value="ラーメン">ラーメン</option>
      <option value="焼肉">焼肉</option>
      <option value="居酒屋">居酒屋</option>
    </select>
    <input type="text" name="keyword" placeholder="キーワードを入力">
    <button type="submit">検索</button>
  </form>
</div>
<div class="shop-container">
  @foreach ($shops as $shop)
  <div class="shop-card">
    <div class="card_img">
      <img src="" alt="{{ $shop->shop_name }}">
    </div>
    <div class="card_content">
      <div>{{ $shop->shop_name }}</div>
      <div>#{{ $shop->area }}</div>
      <div>#{{ $shop->genre }}</div>
      <a href="/detail/{{ $shop->id }}">詳しく見る</a>
      @if ($shop->likes()->where('user_id', auth()->id())->exists())
      <a href="{{ route('unlike', $shop->id) }}" class="btn btn-success btn-sm">
        解除</a>
      @else
      <!-- まだユーザーが「いいね」をしていなければ、「いいね」ボタンを表示 -->
      <a href="{{ route('like', $shop->id) }}" class="btn btn-secondary btn-sm">
        いいね</a>
      @endif
    </div>
  </div>
  @endforeach
</div>
@endsection