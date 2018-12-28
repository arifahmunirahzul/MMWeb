<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use DB;
use App\JobRequest;
use App\JobStatus;
use Carbon\Carbon;

class ChangeStatusToExpired extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'statuschange:expired';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Change status to expired if pending booking exceed the booking date';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $carbon = Carbon::today();
        $result = DB::table('bookings')
                     -> join ('job_requests', 'job_requests.booking_id', '=', 'bookings.booking_id')
                     -> select ('bookings.date_booking', 'job_requests.job_id')
                     ->where('job_requests.status_job', '=', 'Pending')
                     ->get();

        foreach ($result as $data) {
           if($data->date_booking < $carbon->format('Y-m-d'))
           {
                  $job_id = $data->job_id;
                  $jobrequest = JobRequest::find($job_id);
                  $jobrequest->status_job = 'Expired';
                  $jobrequest->save();

                  $jobstatus = new JobStatus;
                  $jobstatus->job_id = $job_id;
                  $jobstatus->job_status = 'Expired';
                  $jobstatus->save();

               
           }
        }
    }
}
