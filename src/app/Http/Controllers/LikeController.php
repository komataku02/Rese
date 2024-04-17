<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Like;
use App\Models\Shop;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function like(Request $request, $shopId)
    {
        // ユーザーが既にその店舗をいいねしているかチェック
        $like = Like::where('shop_id', $shopId)->where('user_id', Auth::id())->first();

        // 既にいいねされている場合は何もしない
        if ($like) {
            return back()->with('error', '既にいいねされています。');
        }

        $like = new Like();
        $like->shop_id = $shopId;
        $like->user_id = Auth::user()->id;
        $like->save();

        return back();
    }

    public function unlike(Request $request, $shopId)
    {

        // ユーザーがその店舗をいいねしているかチェック
        $user = Auth::user();
        $like = Like::where('shop_id', $shopId)->where('user_id', Auth::id())->first();

        // いいねが見つからない場合は何もしない
        if ($like) {
            $like->delete();
        }

        return
            redirect()->back();
    }
}
