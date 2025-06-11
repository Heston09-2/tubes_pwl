<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Ticket;

class Notification extends Model
{
    protected $fillable = [
        'user_id',
        'ticket_id',
        'title',
        'message',
        'is_read',
    ];

    // Relasi ke user (penerima notifikasi)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke ticket (jika notifikasi tentang tiket)
    public function ticket()
    {
        return $this->belongsTo(Ticket::class);
    }
}
