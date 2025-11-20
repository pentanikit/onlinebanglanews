<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'author_id',
        'category_id',
        'featured_image_id',
        'title',
        'slug',
        'subheading',
        'excerpt',
        'content',
        'status',
        'is_breaking',
        'is_featured',
        'published_at',
        'meta_title',
        'meta_description',
    ];

    protected $casts = [
        'published_at' => 'datetime',
        'is_breaking'  => 'boolean',
        'is_featured'  => 'boolean',
    ];

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'post_tag', 'post_id', 'tag_id');
    }


    public function featuredImage()
    {
        return $this->belongsTo(Media::class, 'featured_image_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class)->where('is_approved', true);
    }
}
