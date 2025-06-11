<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'quantity', 'names', 'total_price', 'status', 'valid_until'];

   protected $casts = [
    'names' => 'array',
    'valid_until' => 'date',
];


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
