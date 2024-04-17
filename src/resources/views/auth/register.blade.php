@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endsection

@section('content')
<div class="container">
  @if ($errors->any())
  <div>
    <ul>
      @foreach ($errors->all() as $error)
      <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
  @endif
  <form class="registration-form" action="/register" method="post">
    @csrf
    <div class="registration-form-top">
      <h2 class="registration-title">Registration</h2>
    </div>
    <div class="registration-form-btn">
      <input type="name" name="name" placeholder="Username" value="{{old('name')}}" />
      <input type="email" name="email" placeholder="Email" value="{{old('email')}}" />
      <input type="password" name="password" placeholder="Password" />
      <input type="password" name="password_confirmation" placeholder="Password(確認用)" />
      <div class="form__button">
        <input class="form__button-submit" type="submit" name="button" value="登録" />
      </div>
  </form>
</div>
@endsection