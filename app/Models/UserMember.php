<?php

namespace App\Models;

use App\Models\Casts\Encryption;

class UserMember extends BaseModel
{
    protected $casts = ['password' => Encryption::class];
}
