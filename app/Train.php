<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Train extends Model
{
	
    protected $fillable = [
    	'id', 'url_image', 'created_at'
    ];
    
    public $timestamps = false;
}
