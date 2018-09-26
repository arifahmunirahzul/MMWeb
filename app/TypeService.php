<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\TypeService;

class TypeService extends Model
{
   protected $fillable = [
        'id', 'name', 'created_at', 'updated_at'
        ]; 

    public $timestamps = false;

    public static function getSingleData($id) {
        return TypeService::where('type_services.id',$id)->first();
    }
}
