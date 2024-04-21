<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Shop;
use App\Models\Reserve;
use App\Models\Review;
use App\Models\User;
use App\Http\Requests\ReserveRequest;

class ShopController extends Controller
{
    public function showDetail($shop_id)
    {
        $data = Shop::findOrFail($shop_id);
        $reservations = auth()->check() ? auth()->user()->reserves()->where('reserves.shop_id', $shop_id)->get() : [];

        if (auth()->check()) {
            $user = auth()->user();
            $reservations = $user->reserves()->whereHas('shop', function ($query) use ($shop_id) {
                $query->where('id', $shop_id);
            })->get();
        }


        return view('detail', ['data' => $data, 'reservations' => $reservations]);
    }

    public function create(ReserveRequest $request, $shop_id)
    {
        $reservation = new Reserve();
        $reservation->date = $request->date;
        $reservation->time = $request->time;
        $reservation->number = $request->number;
        $reservation->shop_id = $shop_id;
        $reservation->save();

        $reservation_id = $reservation->id;

        $user = User::find(Auth::id());
        $user->reserves()->attach($reservation_id, ['shop_id' => $shop_id]);

        return redirect('/done');
    }

    public function search(Request $request)
    {
        $query = Shop::query();

        if ($request->filled('area')) {
            $query->where('area', $request->input('area'));
        }

        if ($request->filled('genre')) {
            $query->where('genre', $request->input('genre'));
        }

        if ($request->filled('keyword')) {
            $keyword = $request->input('keyword');
            $query->where(function ($q) use ($keyword) {
                $q->where('shop_name', 'like', "%$keyword%")
                    ->orWhere('area', 'like', "%$keyword%")
                    ->orWhere('genre', 'like', "%$keyword%");
            });
        }

        $shops = $query->get();

        return view('index', compact('shops'));
    }

    public function showReviewForm($shop_id)
    {
        $shop = Shop::findOrFail($shop_id);
        $reservation = null;
        if (auth()->check()) {
            $user = auth()->user();
            $reservation = $user->reserves()->where('reserves.shop_id', $shop_id)->first();
        }

        return view('review', ['shop' => $shop, 'reservation' => $reservation]);
    }

    public function submitReview(Request $request, $shop_id, $reserve_id)
    {

        if (!auth()->check()) {
            return redirect()->back()->with('error', 'ログインしてください。');
        }

        $reservation = Reserve::find($reserve_id);

        $existingReview = Review::where('user_id', auth()->id())
            ->where('shop_id', $shop_id)
            ->where('reserve_id', $reserve_id)
            ->first();

        if ($existingReview) {
            $existingReview->stars = $request->stars;
            $existingReview->comment = $request->comment;
            $existingReview->save();
        } else {
            $review = new Review();
            $review->shop_id = $shop_id;
            $review->user_id = auth()->id();
            $review->reserve_id = $reserve_id;
            $review->stars = $request->stars;
            $review->comment = $request->comment;
            $review->save();
        }

        return redirect()->route('show.detail', ['shop_id' => $shop_id, 'reservation' => $reservation])->with(
            'success',
            'レビューを送信しました。'
        );
    }
}
