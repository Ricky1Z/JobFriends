<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Avatar extends Model
{
    protected $table = 'avatars';
    protected $fillable = [
        'image',
        'price'
    ];

    // Relasi Many-to-Many dengan User
    public function users()
    {
        return $this->belongsToMany(User::class, 'user_avatars', 'avatar_id', 'user_id');
    }
}
