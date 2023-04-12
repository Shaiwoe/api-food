<?php

namespace App\Models;

use App\Models\User;
use App\Models\AdvertisingImage;
use App\Models\CategoryAdvertising;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Advertising extends Model
{
    use HasFactory, SoftDeletes , Sluggable;

    protected $table = 'advertisings';
    protected $guarded = [];


    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }


    public function getStatusAttribute($status)
    {
        switch ($status) {
            case '0':
                $status = 'غیر فعال';
                break;
            case '1':
                $status = 'فعال';
                break;
        }
        return $status;
    }

    public function getApprovedAttribute($approved)
    {
        return $approved ? 'تایید شده' : 'تایید نشده' ;
    }

    public function images()
    {
        return $this->hasMany(AdvertisingImage::class);
    }

    public function category()
    {
        return $this->belongsTo(CategoryAdvertising::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
