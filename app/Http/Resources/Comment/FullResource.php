<?php

namespace App\Http\Resources\Comment;

use Illuminate\Http\Request;
use App\Http\Resources\Article\PartialResource as ArticleResource;
use App\Http\Resources\User\AuthorResource;
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
            'author' => new AuthorResource($this->whenLoaded('author', $this->author)),
            'article' => new ArticleResource($this->whenLoaded('article', $this->article)),
            'author_id' => $this->author_id,
            'article_id' => $this->article_id,
            'updated_at' => $this->updated_at,
            'created_at' => $this->created_at,
        ];
    }
}
