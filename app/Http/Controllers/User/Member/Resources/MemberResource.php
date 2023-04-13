<?php

namespace App\Http\Controllers\User\Member\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MemberResource extends JsonResource
{
    public function toArray($request)
    {
        return ['id' => $this->id, 'username' => $this->username, 'password' => $this->password, 'type' => $this->type, 'created_at' => $this->created_at];
    }
}
