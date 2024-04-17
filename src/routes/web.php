<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MyPageController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\LikeController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;



//ログイン後表示するページ
Route::middleware('auth')->group(function () {
    Route::get('/mypage', [MyPageController::class, 'show'])->name('show');
    Route::get('/mypage/reservations', [MyPageController::class, 'showReservations'])->name('mypage.Sreservations');
    Route::post('/mypage/delete', [MyPageController::class, 'delete'])->name('delete');
    //いいね機能
    Route::get('/like/{shopId}', [LikeController::class, 'like'])->name('like');
    Route::get('/unlike/{shopId}', [likeController::class, 'unlike'])->name('unlike');
    Route::delete('/like/{shopId}', [LikeController::class, 'unlike'])->name('unlike');
    Route::get('/search', [ShopController::class, 'search'])->name('search');
    Route::get('mypage/edit/{reserve_id}', [MyPageController::class, 'edit'])->name('update');
    Route::patch('mypage/update/{reserve_id}', [MyPageController::class, 'update'])->name('update');
});

//ログイン前でも表示できるページ
//店舗一覧表示
Route::get('/', [AuthController::class, 'index']);
//店舗詳細表示
Route::get('/detail/{shop_id}', [ShopController::class, 'showDetail'])->name('show.detail');
//店舗予約処理
Route::post(
    '/detail/{shop_id}',
    [ShopController::class, 'create']
)->name('create');
// レビュー表示ページ
Route::get('/detail/{shop_id}/review/{reserve_id}', [ShopController::class, 'showReviewForm'])->name('showReview');
// レビュー送信処理
Route::post('/detail/{shop_id}/review/{reserve_id}', [ShopController::class, 'submitReview'])->name('submitReview');

Route::get('/done', [AuthController::class, 'done']);

Route::get('/thanks', function () {
    return view('thanks');
});

Auth::routes(['verify' => true]);
Route::middleware('verified')->group(function () {
    Route::get('/mypage', [HomeController::class, 'show'])->name('show');
});
Route::get('/email/verify', function () {
    return view('auth.verify');
})->middleware(['auth'])->name('verification.notice');

Route::middleware(['AdminMiddleware'])->group(function () {
    Route::get('/admin/create_shop_owner', [AdminController::class, 'createShopOwnerForm'])->name('admin.create.shop_owner_form');
    Route::post('/admin/create_shop_owner', [AdminController::class, 'storeShopOwner'])->name('admin.create.shop_owner');
});

Route::middleware(['ShopOwnerMiddleware'])->group(function () {
    Route::get('/admin/create_shop', [AdminController::class, 'createShopForm'])->name('admin.create_shop_form');
    Route::post('/admin/store_shop', [AdminController::class, 'storeShop'])->name('admin.store_shop');
});
