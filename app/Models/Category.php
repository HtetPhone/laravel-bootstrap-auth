<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'author_id'];

    public function user()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function articles()
    {
        return $this->hasMany(Article::class);
    }
}
