<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AdvertisingImage extends Model
{
    use HasFactory , SoftDeletes;

    protected $table = "advertising_images";
    protected $guarded = [];

    
}
