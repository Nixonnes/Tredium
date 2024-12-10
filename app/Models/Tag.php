<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use hasFactory;
    protected $fillable = ['title'];

    public function articles()
    {
        return $this->belongsToMany(Article::class);
    }
}
