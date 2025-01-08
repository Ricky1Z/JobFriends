<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Notification;

class NotificationController extends Controller
{
    public function notification(){
        $notif = Notification::where('user_id', Auth::id())->get();
        return view('notification', compact('notif'));
    }

}
