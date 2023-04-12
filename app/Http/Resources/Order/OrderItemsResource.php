<?php

namespace App\Http\Resources\Order;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderItemsResource extends JsonResource
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
            'title' => Product::find($this->product_id)->title,
            'price' => $this->price,
            'quantity' => $this->quantity,
            'subtotal' => $this->subtotal
        ];
    }
}
