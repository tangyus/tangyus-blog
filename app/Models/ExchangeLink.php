<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExchangeLink extends Model
{
    protected $fillable = [
    	'blog_site', 'blog_name', 'email', 'message'
	];
}
