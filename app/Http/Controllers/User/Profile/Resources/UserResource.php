<?php

namespace App\Http\Controllers\User\Profile\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public function toArray($request)
    {
        return ['id' => $this->id, 'cellphone' => $this->cellphone, 'profile' => ProfileResource::make($this->latestProfile), 'created_at' => $this->created_at];
    }
}
