<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Connection;
use App\Models\Notification;

class ConnectionController extends Controller
{
    public function like(Request $request)
    {
        // Pastikan pengguna sudah login
        if (!auth()->check()) {
            return response()->json(['error' => 'User not logged in'], 401);
        }

        $userId = auth()->user()->id;
        $desiredUserId = $request->input('desired_user_id');
        $status = $request->input('status');

        $thisUser = \App\Models\User::find($userId);
        $thisUserName = $thisUser->name;
        $desiredUser = \App\Models\User::find($desiredUserId);
        $desiredUserName = $desiredUser->name;

        // Cek apakah sudah ada koneksi antara user dan desired_user_id
        $connection = Connection::where('user_id', $userId)
                                ->where('desired_user_id', $desiredUserId)
                                ->first();

        if ($connection) {
            // Jika koneksi sudah ada dan statusnya wishlist, cek apakah koneksi sebaliknya sudah ada
            if ($connection->status === 'wishlist') {
                $reverseConnection = Connection::where('user_id', $desiredUserId)
                                                ->where('desired_user_id', $userId)
                                                ->first();

                if ($reverseConnection && $reverseConnection->status === 'wishlist') {
                    // Jika kedua pengguna sudah saling memberi like, ubah status menjadi connected
                    $connection->status = 'connected';
                    $reverseConnection->status = 'connected';
                    $connection->save();
                    $reverseConnection->save();

                    Notification::create([
                        'user_id' => $userId,
                        'notification' => "You and $desiredUserName are connected now",
                    ]);

                    Notification::create([
                        'user_id' => $desiredUserId,
                        'notification' => "You and $thisUserName are connected now",
                    ]);
                }
            }
        } else {
            // Jika belum ada koneksi, buat koneksi baru dengan status wishlist
            Connection::create([
                'user_id' => $userId,
                'desired_user_id' => $desiredUserId,
                'status' => 'wishlist'
            ]);

            Notification::create([
                'user_id' => $desiredUserId,
                'notification' => "$thisUserName sent you a friend request",
            ]);
        }

        return response()->json(['status' => $connection ? $connection->status : 'wishlist']);
    }
}
