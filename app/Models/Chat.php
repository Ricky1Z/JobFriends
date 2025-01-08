<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    protected $table = 'chats';
    protected $fillable = [
        'user_id',
        'desired_user_id',
        'chat'
    ];

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function desiredUser(){
        return $this->belongsTo(User::class, 'desired_user_id');
    }
}
