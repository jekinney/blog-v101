<?php

namespace App\Models;

use App\Queries\Queries;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Reply extends Queries
{
    use HasFactory, SoftDeletes;

    /**
     * Always eager load relationship(s)
     *
     * @var array
     */
    protected $with = ['author'];

    /**
     * Guarded columns from mass assignment
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * Relationship to User Model and return only the id and name
     */
    public function Author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id', 'id')
            ->select('id', 'name');
    }

    /**
     * Relationship to Comment Model
     */
    public function Comment(): BelongsTo
    {
        return $this->belongsTo(Comment::class);
    }
}
