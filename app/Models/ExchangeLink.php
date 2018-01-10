<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class ExchangeLink extends Model
{
	use Notifiable;
	
    protected $fillable = [
    	'blog_site', 'blog_name', 'email', 'message', 'is_checked'
	];
}
