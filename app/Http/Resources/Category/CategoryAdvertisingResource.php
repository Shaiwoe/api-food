<?php

namespace App\Http\Resources\Category;

use App\Http\Resources\Advertising\AdvertisingResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryAdvertisingResource extends JsonResource
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
            'articles' => AdvertisingResource::collection($this->whenLoaded('advertisings'))
        ];
    }
}
