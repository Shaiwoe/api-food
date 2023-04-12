<?php

namespace App\Models;

use App\Models\Advertising;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CategoryAdvertising extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'category_advertisings';
    protected $guarded = [];


    public function advertisings()
    {
        return $this->hasMany(Advertising::class);
    }
}
