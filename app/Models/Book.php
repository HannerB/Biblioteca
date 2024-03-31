<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;
    
    protected $fillable = ['title', 'author', 'quantity'];

    /**
     * Define the relationship between Book and Loan models.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function loans()
    {
        return $this->hasMany(Loan::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'book_category');
    }
}
