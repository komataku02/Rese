<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Reserve;
use App\Models\User;
use App\Models\Shop;


class MyPageController extends Controller
{
    public function show()
    {

        $user = User::with(['reserves' => function ($query) {
            $query->orderByRaw('CONCAT(date, " ", time)')->orderBy('date')->orderBy('time');
        }, 'reserves.shop'])->find(Auth::id());
        $reservations = $user->reserves;

        $like = $user->likes->pluck('shop_id')->toArray();
        $shops = Shop::whereIn('id', $like)->get();

        return view('mypage', ['reservations' => $reservations, 'shops' => $shops, 'like' => $like]);
    }

    public function showReservations()
    {

        $user = User::with('reserves')->find(Auth::id());
        $reservations = $user->reserves;


        return view('mypage', ['reservations', $reservations]);
    }

    public function delete(Request $request)
    {

        $user = User::find(Auth::id());
        $reservationId = $request->input('reserve_id');

        $user->reserves()->detach($reservationId);

        Reserve::destroy($reservationId);

        return redirect('/mypage');
    }

    public function edit($reserve_id)
    {
        $reservation = Auth::user()->reserves()->findOrFail($reserve_id);

        return view('edit', compact('reservation'));
    }

    public function update(Request $request, $reserve_id)
    {
        $reservation = Auth::user()->reserves()->findOrFail($reserve_id);

        $data = $request->except(['_token']);

        $reservation->update($data);

        return redirect('/mypage')->with('success', '予約情報が更新されました。');
    }
}
