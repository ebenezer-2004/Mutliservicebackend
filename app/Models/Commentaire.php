<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Commentaire extends Model
{
protected $fillable = ['name', 'email', 'contenu', 'blog_id'];
    // public function blog()
    // {
    //     return $this->belongsTo(Blog::class);
    // }
    public function blog()
{
    return $this->belongsTo(Blog::class);
}
}
