<?php

namespace App\Http\Resources\Comment;

use App\Http\Resources\Article\PartialResource as ArticleResource;
use App\Http\Resources\User\AuthorResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PartialResource extends JsonResource
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
            'author' => new AuthorResource($this->whenLoaded('author', $this->author)),
            'article' => new ArticleResource($this->whenLoaded('article', $this->article)),
        ];
    }
}
