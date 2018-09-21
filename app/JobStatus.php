<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JobStatus extends Model
{
    protected $fillable = [
        'jobstatus_id', 'job_id', 'job_status', 'created_at', 'updated_at'
        ]; 

    public $timestamps = false;
}
