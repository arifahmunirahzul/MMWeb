<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\JobRequest;

class JobRequest extends Model
{
	protected $primaryKey = 'job_id';
    protected $fillable = [
        'job_id', 'provider_id', 'booking_id', 'address', 'city', 'postcode', 'state', 'lng', 'lat', 'job_rating', 'feedback', 'status_job', 'created_at', 'updated_at'
        ]; 

    public $timestamps = false;

     public static function getSingleData($job_id) {
        return JobRequest::where('job_requests.job_id',$job_id)->first();
    }
}
