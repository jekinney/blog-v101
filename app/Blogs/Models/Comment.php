<?php

namespace App\Models;

use App\Queries\Queries;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Comment extends Queries
{
    use HasFactory;

    /**
     * Always eager load relationship(s)
     *
     * @var array
     */
    protected $with = ['author'];

    /**
     * Explicitly set casting type by column
     *
     * @var array
     */
    protected $casts = [
        'is_visible' => 'bool',
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
     * Relationship to User Model and return only the id and name
     */
    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id', 'id')
            ->select('id', 'name');
    }

    /**
     * Relationship to Article Model
     */
    public function article(): BelongsTo
    {
        return $this->belongsTo(Article::class);
    }

    /**
     * Relationship to Reply Model
     */
    public function replies(): HasMany
    {
        return $this->hasMany(Reply::class);
    }
}
