<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    public function profile()
    {
        return $this->belongsTo(Profile::class);
    }

    public function interactions()
    {
        return $this->hasMany(Interaction::class);
    }

    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }

    public function incrementViewCount() {
        $this->views++;
        return $this->save();
    }
}
