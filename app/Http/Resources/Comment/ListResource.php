<?php

namespace App\Http\Resources\Comment;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ListResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'body' => $this->body,
            'author' => $this->author,
            'author_id' => $this->author_id,
            'article_id' => $this->article_id,
            'updated_at' => $this->updated_at,
            'created_at' => $this->created_at,
            'deleted' => empty($this->deleted)? false:true,
        ];
    }
}
