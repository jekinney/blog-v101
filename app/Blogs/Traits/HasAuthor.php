<?php

namespace App\Blogs\Traits;

use App\Users\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait HasAuthor
{
    /**
     * Relationship to the User model
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id', 'id')->select('id', 'name');
    }
}
