<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Author extends Model
{
    /** @use HasFactory<\Database\Factories\AuthorFactory> */
    use HasFactory;
    use HasUlids;
    protected $fillable = [
        'name',
        'date_birth',
        'biography',
    ];

    public function books():HasMany
    {
        return $this->hasMany(Book::class);
    }
}
