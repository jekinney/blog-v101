<?php

namespace App\Models;

use App\Queries\Queries;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Queries
{
    use HasFactory;

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

    /// Queries

    /**
     * Attempt to remove a category
     */
    public function remove(): bool
    {
        if ($this->articles_count > 0) {
            return abort(500, 'Unable to remove a category with articles attached.');
        }

        return $this->delete();
    }
}
