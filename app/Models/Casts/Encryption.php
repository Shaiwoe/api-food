<?php

namespace App\Models\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Support\Facades\Crypt;

class Encryption implements CastsAttributes
{
    public function get($model, $key, $value, $attributes)
    {
        if ($value) {
            $value = Crypt::decryptString($value);
        }

        return $value;
    }

    public function set($model, $key, $value, $attributes)
    {
        if ($value) {
            $value = Crypt::encryptString($value);
        }

        return $value;
    }
}
