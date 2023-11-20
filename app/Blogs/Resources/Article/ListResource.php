<?php

namespace App\Http\Resources\Article;

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
            'title' => $this->title,
            'is_draft' => $this->is_draft,
            'publish_at' => $this->publish_at->format('m-d-Y H:i'),
            'is_featured' => $this->is_featured,
            'author_name' => $this->author->name,
            'category_name' => $this->category->name,
        ];
    }
}
