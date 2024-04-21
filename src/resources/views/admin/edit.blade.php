@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="back-btn">
          <a class="back-link" href="/admin/create_shop">back</a>
        </div>
        <div class="card-header">店舗情報を更新する</div>

        <div class="card-body">
          <form method="POST" action="{{ route('admin.update_shop', $shop->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group row">
              <label for="shop_name" class="col-md-4 col-form-label text-md-right">店舗名</label>

              <div class="col-md-6">
                <input id="shop_name" type="text" class="form-control @error('shop_name') is-invalid @enderror" name="shop_name" value="{{ $shop->shop_name }}" required autofocus>

                @error('shop_name')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>

            <div class="form-group">
              <label for="area_id">エリア</label>
              <select name="area_id" id="area_id" class="form-control">
                <option value="1" {{ $shop->area_id == 1 ? 'selected' : '' }}>東京都</option>
                <option value="2" {{ $shop->area_id == 2 ? 'selected' : '' }}>大阪府</option>
                <option value="3" {{ $shop->area_id == 3 ? 'selected' : '' }}>福岡県</option>
              </select>
            </div>

            <div class="form-group row">
              <label for="genre_id" class="col-md-4 col-form-label text-md-right">ジャンル</label>
              <div class="col-md-6">
                <select id="genre_id" name="genre_id" class="form-control @error('genre_id') is-invalid @enderror" required>
                  <option value="1" {{ $shop->genre_id == 1 ? 'selected' : '' }}>イタリアン</option>
                  <option value="2" {{ $shop->genre_id == 1 ? 'selected' : '' }}>ラーメン</option>
                  <option value="3" {{ $shop->genre_id == 1 ? 'selected' : '' }}>居酒屋</option>
                  <option value="4" {{ $shop->genre_id == 1 ? 'selected' : '' }}>寿司</option>
                  <option value="5" {{ $shop->genre_id == 1 ? 'selected' : '' }}>焼肉</option>
                </select>
                @error('genre_id')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>

            <div class="form-group row">
              <label for="overview" class="col-md-4 col-form-label text-md-right">概要</label>

              <div class="col-md-6">
                <textarea id="overview" class="form-control @error('overview') is-invalid @enderror" name="overview" required>{{ $shop->overview }}</textarea>

                @error('overview')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>

            <div class="form-group row">
              <label for="image" class="col-md-4 col-form-label text-md-right">店舗画像</label>
              <div class="col-md-6">
                <input id="image" type="file" class="form-control-file" name="image">
                @error('image')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>

            <div class="form-group row mb-0">
              <div class="col-md-6 offset-md-4">
                <button type="submit" class="btn btn-primary">
                  更新する
                </button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection