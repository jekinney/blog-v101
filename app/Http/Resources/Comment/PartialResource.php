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
            'author' => $this->author,
            'author_id' => $this->author_id,
            'article_id' => $this->article_id,
        ];
    }
}
