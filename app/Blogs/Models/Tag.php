<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    /**
     * Guarded columns from mass assignment
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * Relationship to Tags Model
     */
    public function Tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class);
    }
}
