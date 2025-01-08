<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserAvatar extends Model
{
    protected $table = 'user_avatars';
    protected $fillable = [
        'user_id',
        'avatar_id',
    ];

    // Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke Avatar
    public function avatar()
    {
        return $this->belongsTo(Avatar::class);
    }
}
