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
                  -> select ('job_requests.job_id','job_requests.booking_id', 'job_requests.service', 'users.name', 'job_requests.created_at')
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
}
