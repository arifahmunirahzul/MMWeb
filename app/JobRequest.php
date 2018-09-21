<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JobRequest extends Model
{
    protected $fillable = [
        'job_id', 'provider_id', 'booking_id', 'address', 'city', 'postcode', 'state', 'lng', 'lat', 'job_rating', 'feedback', 'status_job', 'created_at', 'updated_at'
        ]; 

    public $timestamps = false;
}
