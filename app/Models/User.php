<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'gender',
        'phone',
        'linkedin',
        'field',
        'profession',
        'skill',
        'image',
        'coin'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'field' => 'array'
        ];
    }

    public function connections(){
        return $this->hasMany(Connection::class, 'user_id');
    }

    public function connectedUsers() {
        return $this->belongsToMany(User::class, 'connections', 'user_id', 'desired_user_id')
            ->wherePivot('status', 'connected');
    }

    // Relasi Many-to-Many dengan Avatar
    public function avatars()
    {
        return $this->belongsToMany(Avatar::class, 'user_avatars', 'user_id', 'avatar_id');
    }
}
