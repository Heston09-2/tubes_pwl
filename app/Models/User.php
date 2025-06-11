<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

use App\Models\Artwork;
use App\Models\Ticket;
use App\Models\Favorite;
use App\Models\Notification;

class User extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function favorites()
{
    return $this->belongsToMany(Artwork::class, 'favorites')->withTimestamps();
}
 public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }
    public function favorit()
{
    return $this->hasMany(Favorite::class);
}
    public function notifications()
{
    return $this->hasMany(Notification::class);
}


}
