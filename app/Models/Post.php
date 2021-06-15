<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;

    protected $guarded = [];

    //relationships
    //one to many
    public function category()
    {
        return $this->BelongsTo(Category::class);
    }

    //relationship many to many
    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }


    //mutator
    public function getImageAttribute($image)
    {
        return asset('storage/posts/'.$image);
    }

    public function getCreatedAttribute($date){
        return Carbon::parse($date)->format('d-M-Y');
    }
}
