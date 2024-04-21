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
      <img src="{{ asset('storage/' . $shop->image) }}" alt="{{ $shop->shop_name }}">
    </div>
    <div class="card_content">
      <div>{{ $shop->shop_name }}</div>
      <div>#{{ $shop->area }}</div>
      <div>#{{ $shop->genre }}</div>
      <a class="detail-link" href="/detail/{{ $shop->id }}">詳しく見る</a>
      @if ($shop->likes()->where('user_id', auth()->id())->exists())
      <form method="post" action="{{ route('unlike', $shop->id) }}">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-success btn-sm">〇</button>
      </form>
      @else
      <form method="post" action="{{ route('like', $shop->id) }}">
        @csrf
        <button type="submit" class="btn btn-secondary btn-sm">〇</button>
      </form>
      @endif
    </div>
  </div>
  @endforeach
</div>
@endsection