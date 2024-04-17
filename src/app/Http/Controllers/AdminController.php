<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use App\Models\Shop;

class AdminController extends Controller
{
    public function createShopOwnerForm()
    {
        return view('admin.admin');
    }

    public function storeShopOwner(Request $request)
    {
        // バリデーションを追加することもできます

        // 新しい店舗代表者のユーザーレコードを作成
        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password'));
        $user->save();

        // 店舗代表者のロールを取得
        $shopOwnerRole = Role::where('name', 'shop_owner')->first();

        // ユーザーに店舗代表者のロールを付与
        $user->roles()->attach($shopOwnerRole);

        return redirect()->route('admin.create.shop_owner_form')->with('success', '店舗代表者が作成されました。');
    }

    public function createShopForm()
    {
        return view('admin.create');
    }

    public function storeShop(Request $request)
    {
        // バリデーション
        $validatedData = $request->validate([
            'shop_name' => 'required|string|max:255',
            'area_id' => 'required|numeric',
            'genre_id' => 'required|numeric',
            'overview' => 'required|string',
            'image' => 'nullable|image|max:2048',
        ]);

        // エリアとジャンルの文字列を取得
        $area = '';
        switch ($validatedData['area_id']) {
            case 1:
                $area = '東京都';
                break;
            case 2:
                $area = '大阪府';
                break;
            case 3:
                $area = '福岡県';
                break;
                // 他のエリアの場合の処理を追加する場合はここに追加
        }

        $genre = '';
        switch ($validatedData['genre_id']) {
            case 1:
                $genre = 'イタリアン';
                break;
            case 2:
                $genre = 'ラーメン';
                break;
            case 3:
                $genre = '居酒屋';
                break;
            case 4:
                $genre = '寿司';
                break;
            case 5:
                $genre = '焼肉';
                break;
                // 他のジャンルの場合の処理を追加する場合はここに追加
        }

        if ($request->hasFile('image')) {
            // 画像を保存し、そのパスを取得
            $imagePath = $request->file('image')->store('shop_images', 'public');

            // データベースに画像のパスを保存
            $validatedData['image'] = $imagePath;
        }

        // 新しい店舗を作成
        Shop::create([
            'shop_name' => $validatedData['shop_name'],
            'area_id' => $validatedData['area_id'],
            'area' => $area,
            'genre_id' => $validatedData['genre_id'],
            'genre' => $genre,
            'overview' => $validatedData['overview'],
        ]);

        // リダイレクト
        return redirect()->route('admin.create_shop_form')->with('success', '店舗情報が作成されました。');
    }
}
