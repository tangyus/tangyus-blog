<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ArticleTag extends Model
{
    protected $fillable = [
        'tag_id', 'article_id'
    ];
}
