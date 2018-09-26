<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\TypeEvent;

class TypeEvent extends Model
{
    protected $fillable = [
        'id', 'name', 'created_at', 'updated_at'
        ]; 

    public $timestamps = false;

    public static function getSingleData($id) {
        return TypeEvent::where('type_events.id',$id)->first();
    }
}
