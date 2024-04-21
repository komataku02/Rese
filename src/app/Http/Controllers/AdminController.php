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
        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password'));
        $user->save();


        $shopOwnerRole = Role::where('name', 'shop_owner')->first();

        $user->roles()->attach($shopOwnerRole);

        return redirect()->route('admin.create.shop_owner_form')->with('success', '店舗代表者が作成されました。');
    }

    public function createShopForm()
    {
        $shops = Shop::all();
        return view('admin.create', ['shops' => $shops]);
    }

    public function storeShop(Request $request)
    {
        $validatedData = $request->validate([
            'shop_name' => 'required|string|max:255',
            'area_id' => 'required|numeric',
            'genre_id' => 'required|numeric',
            'overview' => 'required|string',
            'image' => 'nullable|image|max:2048',
        ]);

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
        }

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('shop_images', 'public');

            $validatedData['image'] = $imagePath;
        }

        Shop::create([
            'shop_name' => $validatedData['shop_name'],
            'area_id' => $validatedData['area_id'],
            'area' => $area,
            'genre_id' => $validatedData['genre_id'],
            'genre' => $genre,
            'overview' => $validatedData['overview'],
        ]);

        return redirect()->route('admin.create_shop_form')->with('success', '店舗情報が作成されました。');
    }

    public function editShop($id)
    {
        $shop = Shop::findOrFail($id);

        return view('admin.edit', compact('shop'));
    }

    public function updateShop(Request $request, $id)
    {
        $validatedData = $request->validate([
            'shop_name' => 'required|string|max:255',
            'area_id' => 'required|numeric',
            'genre_id' => 'required|numeric',
            'overview' => 'required|string',
            'image' => 'nullable|image',
        ]);

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
        }

        $shop = Shop::findOrFail($id);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('shop_images', 'public');

            $shop->image = $imagePath;
        }

        $shop->update([
            'shop_name' => $validatedData['shop_name'],
            'area_id' => $validatedData['area_id'],
            'area' => $area,
            'genre_id' => $validatedData['genre_id'],
            'genre' => $genre,
            'overview' => $validatedData['overview'],
        ]);

        return redirect()->route('admin.edit_shop', $id)->with('success', '店舗情報が更新されました。');
    }

    public function showReservations($id)
    {
        $shop = Shop::findOrFail($id);
        $reservations = $shop->reserves()->with('users')->get();

        return view('admin.reservations', compact('shop', 'reservations'));
    }
}
