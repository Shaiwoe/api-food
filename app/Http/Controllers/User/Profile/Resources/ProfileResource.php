<?php

namespace App\Http\Controllers\User\Profile\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProfileResource extends JsonResource
{
    public function toArray($request)
    {
        return ['id' => $this->id, 'name' => $this->name, 'national' => $this->national, 'phone' => $this->phone, 'email' => $this->email, 'address' => $this->address, 'shop_name' => $this->shop_name, 'shop_type' => $this->shop_type, 'shop_phone' => $this->shop_phone, 'shop_address' => $this->shop_address, 'bank_sheba' => $this->bank_sheba, 'bank_name' => $this->bank_name, 'zip_url' => $this->zip_url, 'status' => $this->status, 'created_at' => $this->created_at];
    }
}
