<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Connection;

class WishlistController extends Controller
{
    public function wishlist(){
        $wishlist = Connection::where('user_id', Auth::id())
                            ->where('status', 'wishlist')
                            ->get();
        $friend = Connection::where('user_id', Auth::id())
                            ->where('status', 'connected')
                            ->get();
        return view('wishlist', compact('wishlist', 'friend'));
    }

    public function deleteWishlist($id)
    {
        // Cari connection yang sesuai dengan user_id dan desired_user_id
        $wishlistItem = Connection::where('user_id', Auth::id())
                                   ->where('id', $id)
                                   ->where('status', 'wishlist')
                                   ->first();

        if ($wishlistItem) {
            // Hapus connection dari wishlist
            $wishlistItem->delete();
            return redirect()->route('wishlist')->with('success', 'Wishlist berhasil dihapus!');
        }

        return redirect()->route('wishlist')->with('error', 'Item tidak ditemukan!');
    }

    public function deleteFriend($id)
    {
        // Cari connection yang sesuai dengan user_id dan desired_user_id
        $friendItem = Connection::where('user_id', Auth::id())
                                   ->where('id', $id)
                                   ->where('status', 'connected')
                                   ->first();

        $desired = Connection::where('user_id', $id)
                                   ->where('id', Auth::id())
                                   ->where('status', 'connected')
                                   ->first();
        if ($friendItem) {
            // Hapus connection dari wishlist
            $friendItem->delete();
            $desired->status = 'wishlist';
            $desired->save();
            return redirect()->route('wishlist')->with('success', 'Wishlist berhasil dihapus!');
        }

        return redirect()->route('wishlist')->with('error', 'Item tidak ditemukan!');
    }
}
