<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\JobRequest;

class JobStatus extends Model
{
	  public $primaryKey = 'jobstatus_id';
    protected $fillable = [
        'jobstatus_id', 'job_id', 'job_status', 'created_at', 'updated_at'
        ]; 

    public $timestamps = false;

     public static function CreateStatusJob(){
    	     $lastjob = JobRequest::orderBy('created_at', 'desc')->first();
           $jobstatus = new Jobstatus;
           $jobstatus->job_status = "Pending";
           $jobstatus->job_id =$lastjob->job_id;
           $jobstatus->save();
    }
}
