<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name', 'description'];

    // Relasi One-to-Many ke tabel Books
    public function books()
    {
        return $this->hasMany(Book::class);
    }
}