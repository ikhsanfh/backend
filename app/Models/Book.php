<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'image_url',
        'release_year',
        'price',
        'total_page',
        'category_id',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($book) {
            $book->thickness = static::calculateThickness($book->total_page);
        });

        static::updating(function ($book) {
            $book->thickness = static::calculateThickness($book->total_page);
        });
    }

    private static function calculateThickness($totalPage)
    {
        if ($totalPage <= 100) {
            return 'tipis';
        } elseif ($totalPage >= 101 && $totalPage <= 200) {
            return 'sedang';
        } else {
            return 'tebal';
        }
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    
}
