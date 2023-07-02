<?php

namespace App\Http\Resources\Article;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FullResource extends JsonResource
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
            'author' => $this->author,
            'category' => $this->category,
            'publish_at' => $this->publish_at->format('m-d-Y H:i'),
            'expires_at' => $this->expires_at->format('m-d-Y H:i'),
            'updated_at' => $this->updated_at->format('m-d-Y H:i'),
            'created_at' => $this->created_at->format('m-d-Y H:i'),
            'header_image' => $this->header_image,
            'is_draft' => $this->is_draft,
            'is_featured' => $this->is_featured,
        ];
    }
}
