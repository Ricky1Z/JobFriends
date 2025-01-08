<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $table = 'notifications';
    protected $fillable = [
        'user_id',
        'notification'
    ];

    public function user(){
        return $this->belongsto(User::class, 'notification_id');
    }
}
