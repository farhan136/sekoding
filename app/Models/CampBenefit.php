<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CampBenefit extends Model
{
    use HasFactory;

    protected $fillable = [
        'name','camps_id'
    ];

    public function camp()
    {
        return $this->belongsTo(Camp::class, 'camps_id', 'id'); //parameter kedua adalah milik model CampBenefit, parameter ketiga adalah milik model Camp
    }
}
