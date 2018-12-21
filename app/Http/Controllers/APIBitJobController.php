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
use App\JobStatus;
use App\User;
use Carbon\Carbon;

class APIBitJobController extends Controller
{
    public function SubmitQuotation(Request $request, $job_id)
    {
    	 $status_job = DB::table('job_requests')->where('job_id', '=', $job_id)->value('status_job');
    	 $service_job = DB::table('job_requests')->where('job_id', '=', $job_id)->value('service');
       $provider_id = $request->provider_id;

        $role = DB::table('users')->where('id', '=', $provider_id)->value('role');
        $credit = DB::table('users')->where('id', '=', $provider_id)->value('credit');
        $commission = DB::table('users')->where('id', '=', $provider_id)->value('commission');
        $approval_status = DB::table('users')->where('id', '=', $provider_id)->value('approval_status');
        $service = DB::table('users')->where('id', '=', $provider_id)->value('service');
        $price =$request->price;

        $balance_credit = 0;

        $balance_credit = $credit - ($price*$commission);

        if($role == 'Service Provider' && $status_job == 'Pending' && $service_job == $service && $approval_status == 'Approved' && $balance_credit >= 0)
          {
          	 $BitJob = new BitJob;
	           $BitJob->job_id = $job_id;
	           $BitJob->provider_id = $provider_id;
	           $BitJob->price = Input::get('price');
	           $BitJob->message = Input::get('message');
	           $BitJob->status = 'Pending';
	           $BitJob->save();

               
               return response()->json(['message' => 'Successful Submit Quotation', 'status' => true], 201);
          }

         else
         	return response()->json(['message' => 'Failed to proceed a process and check your credit account', 'status' => false], 401);
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
                        -> select ('bit_jobs.bitjob_id','bit_jobs.job_id','job_requests.booking_id', 'job_requests.service', 'users.name', 'users.company_name', 'bit_jobs.status','bit_jobs.price' ,'bit_jobs.message')
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
        $result = DB::table('bit_jobs')->select('bitjob_id', 'status', 'price')->where('job_id', '=', $job_id)->get();
        $bitjob_no = $request->bitjob_id;
        $booking_no = DB::table('job_requests')->where('job_id', '=', $job_id)->value('booking_id');
        $provider_id = DB::table('bit_jobs')->where('bitjob_id', '=', $bitjob_no )->value('provider_id');
        $customer_id = DB::table('bookings')->where('booking_id', '=', $booking_no)->value('customer_id');
        $credit = DB::table('users')->where('id', '=', $provider_id)->value('credit');
        $commission = DB::table('users')->where('id', '=', $provider_id)->value('commission');

        
        
        if($request->customer_id == $customer_id)
        {

          foreach($result as $data)
          {

            if($data->bitjob_id == $bitjob_no && $data->status == 'Pending')
            {

               $price = 0;
               $balance_credit = 0;

               $price = $data->price;

               $balance_credit = $credit - ($price*$commission);

               $bitjob = BitJob::find($bitjob_no);
               $bitjob->status = 'Accept';
               $bitjob->save();

               $jobrequest = JobRequest::find($job_id);
               $jobrequest->status_job = 'Active';
               $jobrequest->provider_id = $provider_id;
               $jobrequest->save();

               $jobstatus = new JobStatus;
               $jobstatus->job_id = $job_id;
               $jobstatus->job_status = 'Active';
               $jobstatus->save();

               $credit_save = User::find($provider_id);
               $credit_save->credit = $balance_credit;
               $credit_save->save();
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

    public function ViewListBooking ($customer_id)
    {
       $booking = DB::table('bookings')->select('booking_id')->where('customer_id', '=', $customer_id)->get();
       $role = DB::table('users')->where('id', '=', $customer_id)->value('role');
      
       $array = [];

      if($role == 'Customer')
        {
           foreach ($booking as $data) {

             $list_book = DB:: table('bookings')
                            -> join ('job_requests', 'job_requests.booking_id', '=', 'bookings.booking_id')
                            -> join ('bit_jobs', 'bit_jobs.job_id', '=', 'job_requests.job_id')
                            -> select ('bookings.booking_id','bookings.date_booking','bookings.type_service', DB::raw('count(bit_jobs.bitjob_id) as response'), DB::raw('MIN(bit_jobs.price) as minimum_price'), DB::raw('MAX(bit_jobs.price) as maximum_price'), 'job_requests.status_job')
                            ->where('bookings.booking_id', $data->booking_id)
                            -> get();
              foreach ($list_book as $output) {
                     $array[] = [

                          'booking_id'=> $output->booking_id,
                          'date_booking' => $output->date_booking,
                          'service' => $output->type_service,
                          'number_response' => $output->response,
                          'min_price' => $output->minimum_price,
                          'max_price' => $output->maximum_price,
                          'status_job' => $output->status_job
                          

                         ];
              }

             

           }
           return response()->json(['list_booking' => $array]);

         }

      else
        return response()->json(['message' => 'You are not allowed for this process', 'status' => false], 401);

       

    }
}
