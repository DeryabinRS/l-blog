<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'author_id',
        'post_category',
        'title',
        'slug',
        'content',
        'featured_image',
        'tags',
        'meta_keywords',
        'meta_description',
        'visibility',
    ];
}
