<?php

namespace App;
use App\TypeProperty;

use Illuminate\Database\Eloquent\Model;

class TypeProperty extends Model
{
    protected $fillable = [
        'id', 'name', 'created_at', 'updated_at'
        ]; 

    public $timestamps = false;

     public static function getSingleData($id) {
        return TypeProperty::where('type_properties.id',$id)->first();
    }
}
