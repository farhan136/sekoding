<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Camp extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'price',
        'banner'
    ];

    public function benefit()
    {
        return $this->hasMany(CampBenefit::class, 'camps_id', 'id'); //parameter kedua adalah milik model CampBenefit, parameter ketiga adalah milik model Camp
    }
}
