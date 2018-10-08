<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BitJob extends Model
{
	protected $primaryKey = 'bitjob_id';
    protected $fillable = [
        'bitjob_id','job_id', 'provider_id', 'price', 'message','status', 'created_at', 'updated_at'
        ]; 

    public $timestamps = false;
}
