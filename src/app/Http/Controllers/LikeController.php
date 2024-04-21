<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Like;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function like(Request $request, $shopId)
    {
        $like = Like::where('shop_id', $shopId)->where('user_id', Auth::id())->first();

        if ($like) {
            return back()->with('error', '既にいいねされています。');
        }

        $like = new Like();
        $like->shop_id = $shopId;
        $like->user_id = Auth::user()->id;
        $like->save();

        return back();
    }

    public function unlike($shopId)
    {
        $like = Like::where('user_id', auth()->id())->where('shop_id', $shopId)->first();

        if ($like) {
            $like->delete();
        }

        return redirect()->back()->with('success', 'いいねを削除しました。');
    }
}
