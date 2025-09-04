<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Book extends Model
{
    /** @use HasFactory<\Database\Factories\BookFactory> */
    use HasFactory;

    protected $fillable = [
        'title',
        'isbn',
        'year_published',
        'author_id',
        'publisher_id',
        'status_book',
    ];

    public function author():BelongsTo
    {
        return $this->belongsTo(Author::class);
    }

    public function publisher():BelongsTo
    {
        return $this->belongsTo(Publisher::class);
    }

    public function categories():BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }
}
