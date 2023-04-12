<?php

namespace App\Http\Resources\Order;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
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
            'status' => $this->status,
            'payment_status' => $this->payment_status,
            'paying_amount' => $this->paying_amount,
            'created_at' => verta($this->created_at)->format('%B %d، %Y'),
            'order_items' => OrderItemsResource::collection($this->whenLoaded('orderItems'))
        ];
    }
}
