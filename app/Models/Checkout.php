<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Checkout extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'camp_id',
        'payment_status',
        'midtrans_url'
    ];

    public function camps()
    {
        return $this->belongsTo(Camp::class, 'camp_id', 'id'); //parameter kedua adalah milik model Checkout, parameter ketiga adalah milik model Camp
    }

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id', 'id'); //parameter kedua adalah milik model Checkout, parameter ketiga adalah milik model User
    }
}
