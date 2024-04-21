@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="back-btn">
          <a class="back-link" href="/admin/create_shop">back</a>
        </div>
        <div class="card-header">店舗の予約情報</div>

        <div class="card-body">
          <table class="table">
            <thead>
              <tr>
                <th>予約者名</th>
                <th>日時</th>
                <th>人数</th>
              </tr>
            </thead>
            <tbody>
              @foreach($reservations as $reservation)
              <tr>
                <td>
                  @if($reservation->users->isNotEmpty())
                  {{ $reservation->users->first()->name }}
                  @else
                  ユーザーが存在しません
                  @endif
                </td>
                <td>{{ $reservation->date }} {{ $reservation->time }}</td>
                <td>{{ $reservation->number }}</td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection