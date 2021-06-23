<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $appends = ['foto'];

    //accesor
    public function getFotoAttribute()
    {
        return asset('storage/photos/'.$this->image);
    }
}
