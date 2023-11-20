<?php

namespace App\Models;

use App\Queries\EloquentQueries;
use App\Blogs\Traits\HasAuthor;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\{
    HasMany,
    BelongsTo,
    BelongsToMany,
    HasManyThrough
};

class Article extends EloquentQueries
{
    use HasFactory, HasAuthor;

    /**
     * Always eager load relationship(s)
     *
     * @var array
     */
    protected $with = [
        'author',
        'category',
    ];

    /**
     * Explicitly set casting type by column
     *
     * @var array
     */
    protected $casts = [
        'is_draft' => 'bool',
        'expires_at' => 'datetime',
        'publish_at' => 'datetime',
        'is_featured' => 'bool',
    ];

    /**
     * Guarded columns from mass assignment
     *
     * @var array
     */
    protected $guarded = [
        'id',
        'updated_at',
        'created_at',
    ];

    /**
     * Always eager load count of relationship(s)
     *
     * @var array
     */
    protected $withCount = ['comments'];

    /**
     * Relationship to Tags Model
     */
    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class);
    }

    /**
     * Relationship to User Model and return only the id and name
     */
    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id', 'id')
            ->select('id', 'name');
    }

    /**
     * Relationship to Category Model
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Relationship to Comment Model
     */
    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * Relationship to Reply Model
     */
    public function replies(): HasManyThrough
    {
        return $this->hasManyThrough(Reply::class, Comment::class);
    }
}
