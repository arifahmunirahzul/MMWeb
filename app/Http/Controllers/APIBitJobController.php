<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use DB;
use App\BitJob;
use App\JobRequest;
use Carbon\Carbon;

class APIBitJobController extends Controller
{
    public function SubmitQuotation(Request $request, $job_id)
    {
    	$status_job = DB::table('job_requests')->where('job_id', '=', $job_id)->value('status_job');
    	$service_job = DB::table('job_requests')->where('job_id', '=', $job_id)->value('service');
        $provider_id = $request->provider_id;

        $role = DB::table('users')->where('id', '=', $provider_id)->value('role');
        $service = DB::table('users')->where('id', '=', $provider_id)->value('service');

        if($role == 'Service Provider' && $status_job == 'Pending' && $service_job == $service)
          {
          	   $BitJob = new BitJob;
	           $BitJob->job_id = $job_id;
	           $BitJob->provider_id = $provider_id;
	           $BitJob->price = Input::get('price');
	           $BitJob->message = Input::get('message');
	           $BitJob->status = 'Pending';
	           $BitJob->save();
               
               return response()->json(['message' => 'Successful Submit Quatation', 'status' => true], 201);
          }

         else
         	return response()->json(['message' => 'Failed to proceed a process', 'status' => false], 401);
    }

    public function ViewQuotation (Request $request, $job_id)
    {
        $booking_no = DB::table('job_requests')->where('job_id', '=', $job_id)->value('booking_id');
        $customer_id = DB::table('bookings')->where('booking_id', '=', $booking_no)->value('customer_id');
        
        if($request->customer_id == $customer_id)
        {
            $quotations = DB:: table('bit_jobs')
                  -> join ('job_requests', 'job_requests.job_id', '=', 'bit_jobs.job_id')
                  -> join ('bookings', 'bookings.booking_id', '=', 'job_requests.booking_id')
                  -> join ('users', 'users.id', '=', 'bit_jobs.provider_id')
                  -> select ('bit_jobs.bitjob_id','bit_jobs.job_id','job_requests.booking_id', 'job_requests.service', 'users.name', 'bit_jobs.status','bit_jobs.price' ,'bit_jobs.message')
                  ->where('bit_jobs.job_id', $job_id)
                  ->where('bit_jobs.status', '=', 'Pending')
                  -> get();
            return response()->json($quotations);
        }

        else
          return response()->json(['message' => 'You are not allowed for this process', 'status' => false], 401);
        
    }

     public function ConfirmQuotation (Request $request, $job_id)
    {
        $result = DB::table('bit_jobs')->select('bitjob_id', 'status')->where('job_id', '=', $job_id)->get();
        $bitjob_no = $request->bitjob_id;
        $booking_no = DB::table('job_requests')->where('job_id', '=', $job_id)->value('booking_id');
        $customer_id = DB::table('bookings')->where('booking_id', '=', $booking_no)->value('customer_id');
        
        if($request->customer_id == $customer_id)
        {

          foreach($result as $data)
          {
            if($data->bitjob_id == $bitjob_no && $data->status == 'Pending')
            {
               $bitjob = BitJob::find($bitjob_no);
               $bitjob->status = 'Accept';
               $bitjob->save();
            }

            else if ($data->bitjob_id != $bitjob_no && $data->status == 'Pending')
            {
               $bitjob_number = $data->bitjob_id;            
               $bitjob = BitJob::find($bitjob_number );
               $bitjob->status = 'Unaccepted';
               $bitjob->save();
            }

            else
               return response()->json(['message' => 'Status are not in Pending Mood', 'status' => false], 401);
          }

          return response()->json(['message' => 'You booking is completed', 'status' => true], 201);  
        }

        else
          return response()->json(['message' => 'You are not allowed for this process', 'status' => false], 401);
        
    }
}
