<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TypeProperty extends Model
{
    protected $fillable = [
        'id', 'name', 'created_at', 'updated_at'
        ]; 

    public $timestamps = false;
}
