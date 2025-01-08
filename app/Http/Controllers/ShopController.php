<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Avatar;

class ShopController extends Controller
{
    public function shop(){
        $user = auth()->user();
        // Mengambil avatar yang belum dimiliki oleh user
        $avatar = Avatar::whereNotIn('id', $user->avatars->pluck('id'))->get();
        return view('shop', compact('avatar'));
    }

    public function topup(){
        $user = auth()->user();
        $user->coin += 100;
        $user->save();

        return redirect()->back()->with('success', 'Top-up successful! 100 coins have been added.');
    }

    public function buyAvatar($avatarId){
        $user = auth()->user();
        $avatar = Avatar::find($avatarId);
        $remainderCoin = $user->coin - $avatar->price;

        // Pastikan pengguna belum memiliki avatar ini
        if (!$user->avatars->contains($avatarId)) {
            if($remainderCoin >= 0){
                $user->avatars()->attach($avatarId);  // Menambahkan avatar ke pengguna
                $user->coin -= $avatar->price;
                $user->save();
                return redirect()->back()->with('successs', 'Avatar successfully purchased!');
            }
            else{
                return redirect()->back()->with('error', 'Your coin is not enough!');
            }
        }
        return redirect()->back()->with('error', 'You already have this avatar!');
    }
}
