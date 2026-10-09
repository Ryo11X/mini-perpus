<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = ['category_id', 'title', 'author', 'published_year', 'stock'];

    // Relasi ke tabel Category (kebalikan dari hasMany)
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}