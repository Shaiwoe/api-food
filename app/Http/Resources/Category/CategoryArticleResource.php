<?php

namespace App\Http\Resources\Category;

use App\Http\Resources\Article\ArticleResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryArticleResource extends JsonResource
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
            'name' => $this->name,
            'description' => $this->description,
            'articles' => ArticleResource::collection($this->whenLoaded('articles'))
        ];
    }
}
