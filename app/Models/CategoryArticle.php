<?php

namespace App\Models;

use App\Models\Article;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CategoryArticle extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'category_article';
    protected $guarded = [];


    public function articles()
    {
        return $this->hasMany(Article::class);
    }
}
