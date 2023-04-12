<?php

namespace App\Models;

use App\Models\ArticleComment;
use App\Models\CategoryArticle;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Article extends Model
{
    use HasFactory, SoftDeletes , Sluggable;

    protected $table = 'articles';
    protected $guarded = [];

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    public function getTypeAttribute($type)
    {
        switch ($type) {
            case '0':
                $type = 'مقاله';
                break;
            case '1':
                $type = 'خبر';
                break;
            case '2':
                $type = 'ویدیو';
                break;
            case '3':
                $type = 'معرفی';
                break;
        }
        return $type;
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

    public function approvedComments()
    {
        return $this->hasMany(ArticleComment::class)->where('approved' , 1);
    }

    public function category()
    {
        return $this->belongsTo(CategoryArticle::class);
    }
}
