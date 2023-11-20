<?php

namespace App\Models;

use App\Queries\EloquentQueries;
use App\Blogs\Traits\HasAuthor;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends EloquentQueries
{
    use HasFactory, HasAuthor;

    /**
     * Guarded columns from mass assignment
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * Always Eager load relationship count
     *
     * @var array
     */
    protected $withCount = ['articles'];

    /**
     * Relationship to Article Model
     */
    public function articles(): HasMany
    {
        return $this->hasMany(Article::class);
    }
}
