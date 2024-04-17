<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shop;
use App\Models\Like;


class AuthController extends Controller
{
    public function index(Shop $shop)
    {
        $shops = Shop::get();
        $likes = [];

        if (auth()->check()) {
            $likes = Like::whereIn('shop_id', $shops->pluck('id'))->where('user_id', auth()->user()->id)->pluck('shop_id')->toArray();
        }

        return view('index', ['shops' => $shops,'likes' => $likes]);
    }

    public function done()
    {
        return view('/done');
    }

    public function thank()
    {
        return redirect('/thanks');
    }
}