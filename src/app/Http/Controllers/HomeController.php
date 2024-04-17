<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reserve;
use App\Models\User;
use App\Models\Like;
use App\Models\Shop;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('verified');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Shop $shop)
    {
        $shops = Shop::get();
        $likes = [];

        if (auth()->check()) {
            $likes = Like::whereIn('shop_id', $shops->pluck('id'))->where('user_id', auth()->user()->id)->pluck('shop_id')->toArray();
        }

        return view('index', ['shops' => $shops, 'likes' => $likes]);
    }

    public function show()
    {
        $user = User::with(['reserves' => function ($query) {
            // 予約日時の近い順にソートする
            $query->orderBy('date')->orderBy('time');
        }, 'reserves.shop'])->find(Auth::id());
        $reservations = $user->reserves;

        // いいねした店舗情報を取得
        $like = $user->likes->pluck('shop_id')->toArray();
        $shops = Shop::whereIn('id', $like)->get();

        return view('mypage', ['reservations' => $reservations, 'shops' => $shops, 'like' => $like]);
    }
}
