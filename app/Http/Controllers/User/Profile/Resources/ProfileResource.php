<?php

namespace App\Http\Controllers\User\Profile\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProfileResource extends JsonResource
{
    public function toArray($request)
    {
        return ['id' => $this->id, 'name' => $this->name, 'national' => $this->national, 'phone' => $this->phone, 'email' => $this->email, 'address' => $this->address, 'status' => $this->status, 'created_at' => $this->created_at];
    }
}
