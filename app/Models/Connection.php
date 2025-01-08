<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Connection extends Model
{
    protected $table = 'connections';
    protected $fillable = [
        'user_id',
        'desired_user_id',
        'status'
    ];

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function desiredUser(){
        return $this->belongsTo(User::class, 'desired_user_id');
    }
}
