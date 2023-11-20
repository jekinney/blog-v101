<?php

namespace App\Blogs\Traits;

use App\Blogs\Models\{
    Reply,
    Article,
    Comment
};
use Illuminate\Database\Eloquent\Relations\HasMany;

trait HasBlog
{
    /**
     * Get all of the replies for the user
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function replies(): HasMany
    {
        return $this->hasMany(Reply::class, 'author_id', 'id');
    }

    /**
     * Get all of the articles for the user
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function articles(): HasMany
    {
        return $this->hasMany(Article::class, 'author_id', 'id');
    }

    /**
     * Get all of the comments for the HasBlog
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class, 'author_id', 'id');
    }
}
