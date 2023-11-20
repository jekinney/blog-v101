<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Reply extends Model
{
    use HasFactory;

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
