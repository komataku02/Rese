@extends('layouts.app')
<style>
  th {
    background-color: #289ADC;
    color: white;
    padding: 5px 40px;
  }

  tr:nth-child(odd) td {
    background-color: #FFFFFF;
  }

  td {
    padding: 25px 40px;
    background-color: #EEEEEE;
    text-align: center;
  }

  button {
    padding: 10px 20px;
    background-color: #289ADC;
    border: none;
    color: white;
  }
</style>

@section('content')
<form action="{{ route('update', $reservation->id) }}" method="POST">
  <table>
    @csrf
    @method('PATCH')
    <tr>
      <th>
        日付
      </th>
      <td>
        <input type="date" name="date" id="date" >
      </td>
    </tr>
    <tr>
      <th>
        時間
      </th>
      <td>
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
        </select>
      </td>
    </tr>
    <tr>
      <th>
        人数
      </th>
      <td>
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
      </td>
    </tr>
    <th></th>
    <td>
      <button>送信</button>
    </td>
    </tr>
  </table>
</form>
@endsection