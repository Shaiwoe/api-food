<?php

namespace App\Http\Resources\Product;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
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
            'title' => $this->title,
            'status_value' => $this->getRawOriginal('status'),
            'status' => $this->status,
            'price' => $this->price,
            'quantity' => $this->quantity,
            'is_sale' => $this->is_sale,
            'sale_price' => $this->sale_price,
            'date_on_sale_from_jalali' => verta($this->date_on_sale_from)->formatDatetime(),
            'date_on_sale_to_jalali' => verta($this->date_on_sale_to)->formatDatetime(),
            'date_on_sale_from' => $this->date_on_sale_from,
            'date_on_sale_to' => $this->date_on_sale_to,

        ];
    }
}
