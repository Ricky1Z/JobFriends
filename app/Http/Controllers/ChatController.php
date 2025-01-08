<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Chat;
use App\Models\Connection;
use App\Models\Notification;

class ChatController extends Controller
{
    public function index() {
        $user = auth()->user();
        $connections = $user->connections()->where('status', 'connected')->get();
        return view('chat', compact('user', 'connections'));
    }

    public function showChat($desiredUserId) {
        $user = auth()->user();
        $desiredUser = User::findOrFail($desiredUserId);

        // Validasi hubungan
        if (!$user->connections()->where('desired_user_id', $desiredUserId)->where('status', 'connected')->exists()) {
            abort(403, 'Unauthorized access');
        }

        $chats = Chat::where(function ($query) use ($user, $desiredUserId) {
            $query->where('user_id', $user->id)->where('desired_user_id', $desiredUserId);
        })->orWhere(function ($query) use ($user, $desiredUserId) {
            $query->where('user_id', $desiredUserId)->where('desired_user_id', $user->id);
        })->orderBy('created_at', 'asc')->get();

        return view('sendMessage', compact('user', 'desiredUser', 'chats'));
    }

    public function sendMessage(Request $request, $desiredUserId) {
        $user = auth()->user();
        $thisUserName = $user->name;

        $desiredUser = \App\Models\User::find($desiredUserId);
        $desiredUserName = $desiredUser->name;

        $request->validate([
            'chat' => 'required|string|max:1000',
        ]);

        // Simpan pesan baru
        Chat::create([
            'user_id' => $user->id,
            'desired_user_id' => $desiredUserId,
            'chat' => $request->chat,
        ]);

        Notification::create([
            'user_id' => $desiredUserId,
            'notification' => "$thisUserName sent you a message",
        ]);

        return redirect()->route('chat-show', $desiredUserId);
    }
}
