<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $appends = ['foto'];

    //accesor
    public function getFotoAttribute()
    {
        return asset('storage/sliders/'.$this->image);
    }
}
