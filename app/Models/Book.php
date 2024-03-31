<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;
    
    protected $fillable = ['title', 'author', 'quantity'];

    // Relación con la tabla loans
    public function loans()
    {
        return $this->hasMany(Loan::class);
    }

    // Relación con la tabla categories
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'book_category');
    }
}
