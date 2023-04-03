<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class News extends Model
{
    use HasFactory;
    protected $table = 'news';
    protected $fillable = [
        'title',
        'slug',
        'image',
        'content',
        'author'
    ];

    public function Comments(): HasMany 
    {
        return $this->hasMany(Comment::class);
    }
}
