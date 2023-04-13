<?php

namespace App\Http\Controllers\User\Order\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    public function toArray($request)
    {
        return ['id' => $this->id, 'total' => $this->total, 'amount' => $this->amount, 'reference' => $this->reference, 'status' => $this->status, 'created_at' => $this->created_at];
    }
}
