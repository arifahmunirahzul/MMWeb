<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use App\JobRequest;
use App\Booking;
use App\BitJob;
use App\User;
use App\JobStatus;
use Auth;
use DB;

class JobController extends Controller
{
    public function viewPendingJob()
    {
    	  $service = Auth::user()->service;
        $jobrequest = DB:: table('job_requests')
                  -> join ('bookings', 'bookings.booking_id', '=', 'job_requests.booking_id')
                  -> join ('users', 'users.id', '=', 'bookings.customer_id')
                  -> select ('job_requests.job_id','job_requests.booking_id', 'job_requests.service', 'users.name', 'job_requests.created_at', 'bookings.date_booking')
                   ->where('job_requests.status_job', '=', 'Pending')
                   ->where('job_requests.service', '=', $service )
                  -> orderBy('job_requests.job_id','DESC')
                  -> get();
         return view('job.pending', compact('jobrequest')); 
    }

    public function viewJob($job_id)
    {
       $jobs = DB:: table('job_requests')
                  -> join ('bookings', 'bookings.booking_id', '=', 'job_requests.booking_id')
                  -> select ('job_requests.job_id','job_requests.booking_id', 'job_requests.service','job_requests.address','job_requests.city', 'job_requests.postcode','job_requests.state', 'bookings.date_booking', 'bookings.duration', 'bookings.type_property', 'bookings.clean_area', 'bookings.package', 'bookings.total_visitor', 'bookings.type_event',  'bookings.message')
                  ->where('job_requests.job_id', $job_id)
                  -> get();
        return view('job.view-job', [
            'jobs' => $jobs

        ]);
    }

    public function viewQuotation($job_id)
    {
        $data = JobRequest::getSingleData($job_id);
        return view('job.submit-quotation', [
            'data' => $data

        ]);
    }

     public function SubmitQuotation(Request $request, $job_id){
        
        $bitjob = new BitJob;
        $bitjob->job_id = $job_id;
        $bitjob->provider_id = Input::get('provider_id');
        $bitjob->price = Input::get('price');
        $bitjob->message = Input::get('message');
        $bitjob->status = 'Pending';
        $bitjob->save();
        return redirect()->route('viewPendingJob')->with('flash_message_success', 'Quotation has been successfully submit');
    }

    public function viewStatusQuotation()
    {
    	  $id = Auth::user()->id;
        $jobstatus = DB:: table('bit_jobs')
                  -> join ('job_requests', 'job_requests.job_id', '=', 'bit_jobs.job_id')
                   -> join ('bookings', 'bookings.booking_id', '=', 'job_requests.booking_id')
                  -> join ('users', 'users.id', '=', 'bookings.customer_id')
                  -> select ('bit_jobs.job_id','job_requests.booking_id', 'job_requests.service', 'users.name', 'bit_jobs.status', 'bit_jobs.price', 'bit_jobs.message')
                   ->where('bit_jobs.provider_id', '=', $id)
                  -> orderBy('bit_jobs.updated_at','DESC')
                  -> get();
         return view('job.status-quotation', compact('jobstatus'));
    }

    public function ListPendingJob()
    {
        $jobrequest = DB:: table('job_requests')
                  -> join ('bookings', 'bookings.booking_id', '=', 'job_requests.booking_id')
                  -> join ('users', 'users.id', '=', 'bookings.customer_id')
                  -> select ('job_requests.job_id','job_requests.booking_id', 'job_requests.service', 'users.name', 'job_requests.created_at', 'job_requests.status_job')
                  -> orderBy('job_requests.job_id','DESC')
                  -> get();
         return view('job.list-pending', compact('jobrequest'));
    }

     public function ProviderQuotation()
    {
      
        $jobstatus = DB:: table('bit_jobs')
                  -> join ('job_requests', 'job_requests.job_id', '=', 'bit_jobs.job_id')
                   -> join ('bookings', 'bookings.booking_id', '=', 'job_requests.booking_id')
                  -> join ('users', 'users.id', '=', 'bit_jobs.provider_id')
                  -> select ('bit_jobs.job_id','job_requests.booking_id', 'job_requests.service', 'users.name', 'bit_jobs.status','bit_jobs.price', 'bit_jobs.message')
                  -> orderBy('bit_jobs.updated_at','DESC')
                  -> get();
         return view('job.provider-quotation', compact('jobstatus'));
    }

    public function grabjob(Request $request)
    {
        $provider_id =Auth::user()->id;
        $job_id = $request->job_id;


        $status_job = DB::table('job_requests')->where('job_id', '=', $job_id)->value('status_job'); 
        $booking_id = DB::table('job_requests')->where('job_id', '=', $job_id)->value('booking_id');
        $duration = DB::table('bookings')->where('booking_id', '=', $booking_id)->value('duration');
        $message = DB::table('users')->where('id', '=', $provider_id)->value('about_me');
        $credit = DB::table('users')->where('id', '=', $provider_id)->value('credit');
        $commission = DB::table('users')->where('id', '=', $provider_id)->value('commission');

        $price = 0;
        $price = $duration*25.00;

        $balance_credit = 0;

        $balance_credit = $credit - ($price*$commission);

        if($status_job == 'Pending' && $balance_credit >= 0)
        {
          $jobrequest = JobRequest::find($job_id);
          $jobrequest->status_job = 'Completed';
          $jobrequest->provider_id = $provider_id;
          $jobrequest->save();

          $bitjob = new BitJob;
          $bitjob->job_id = $job_id;
          $bitjob->provider_id = $provider_id;
          $bitjob->price = $price;
          $bitjob->message = $message;
          $bitjob->status = 'Accept';
          $bitjob->save();

          $credit_save = User::find($provider_id);
          $credit_save->credit = $balance_credit;
          $credit_save->save();

          $jobstatus = new JobStatus;
          $jobstatus->job_id = $job_id;
          $jobstatus->job_status = 'Completed';
          $jobstatus->save();

          return redirect()->route('viewPendingJob')->with('flash_message_success', 'You have grab this job'); 
        }

        else
          return redirect()->route('viewPendingJob')->with('flash_message_error', 'Cannot grab job, Please check your credit amount');
    }

   
}
