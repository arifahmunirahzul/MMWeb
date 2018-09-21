<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use DB;

class APIJobRequestController extends Controller
{
     public function PendingJobRequests($provider_id)
    {
         //list pending job
        $service = DB::table('users')->where('id', '=', $provider_id)->value('service');
        $role = DB::table('users')->where('id', '=', $provider_id)->value('role');
        $approval_status = DB::table('users')->where('id', '=', $provider_id)->value('approval_status');
    	if($role == 'Service Provider' && $approval_status == 'Approved' && $service == 'Pembantu Rumah')
    	  {
          $result = DB:: table('job_requests')
                  -> join ('bookings', 'bookings.booking_id', '=', 'job_requests.booking_id')
                  -> join ('users', 'users.id', '=', 'bookings.customer_id')
                  -> select ('job_requests.job_id','job_requests.service', 'job_requests.address', 'job_requests.city', 'job_requests.postcode', 'job_requests.state', 'job_requests.lng', 'job_requests.lat' ,'job_requests.status_job','users.name','users.email','users.u_phone', 'bookings.date_booking', 'bookings.duration', 'bookings.type_property', 'bookings.clean_area', 'bookings.message')
                  -> where('job_requests.status_job','Pending')
                  -> where('job_requests.service', 'Pembantu Rumah')
                  ->get();

           
   
          $array = [];
                    foreach($result as $data){
                   
                    $array[] = [
                                  'job_id'=> $data->job_id,
                                  'current_status'=> $data->status_job,
                                  'service' => $data->service,
                                  'c_name' => $data->name,
                                  'c_email' => $data->email,
                                  'c_phone' => $data->u_phone,
                                  'c_address' => $data->address,
                                  'c_city' => $data->city,
                                  'c_postcode' => $data->postcode,
                                  'c_state' => $data->state,
                                  'lat' => $data->lat,
                                  'lng' => $data->lng,
                                  'message' => $data->message,
                                  'date_booking'=> $data->date_booking,
                                  'duration' => $data->duration,
                                  'type_property' => $data->type_property,
                                  'clean_area' => $data->clean_area
                                  
                                ];
                    
                    }

                    return response()->json($array);
            }

            else if($role == 'Service Provider' && $approval_status == 'Approved' && $service == 'Katering')
	    	  {
	          $result = DB:: table('job_requests')
	                  -> join ('bookings', 'bookings.booking_id', '=', 'job_requests.booking_id')
	                  -> join ('users', 'users.id', '=', 'bookings.customer_id')
	                  -> select ('job_requests.job_id','job_requests.service', 'job_requests.address', 'job_requests.city', 'job_requests.postcode', 'job_requests.state', 'job_requests.lng', 'job_requests.lat','job_requests.status_job','users.name','users.email','users.u_phone', 'bookings.date_booking', 'bookings.total_visitor', 'bookings.type_event','bookings.message')
	                  -> where('job_requests.status_job','Pending')
	                  -> where('job_requests.service', 'Katering')
	                  ->get();

	           
	   
	          $array = [];
	                    foreach($result as $data){
	                   
	                    $array[] = [
	                                  'job_id'=> $data->job_id,
	                                  'current_status'=> $data->status_job,
	                                  'service' => $data->service,
	                                  'c_name' => $data->name,
	                                  'c_email' => $data->email,
	                                  'c_phone' => $data->u_phone,
	                                  'c_address' => $data->address,
	                                  'c_city' => $data->city,
	                                  'c_postcode' => $data->postcode,
	                                  'c_state' => $data->state,
	                                  'lat' => $data->lat,
	                                  'lng' => $data->lng,
	                                  'message' => $data->message,
	                                  'date_booking'=> $data->date_booking,
	                                  'total_visitor' => $data->total_visitor,
	                                  'type_event' => $data->type_event
	                                  
	                                ];
	                    
	                    }

	                    return response()->json($array);
	            }

	        else if($role == 'Service Provider' && $approval_status == 'Approved' && $service == 'Urut Pantang')
	    	  {
	          $result = DB:: table('job_requests')
	                  -> join ('bookings', 'bookings.booking_id', '=', 'job_requests.booking_id')
	                  -> join ('users', 'users.id', '=', 'bookings.customer_id')
	                  -> select ('job_requests.job_id','job_requests.service', 'job_requests.address', 'job_requests.city', 'job_requests.postcode', 'job_requests.state', 'job_requests.lng', 'job_requests.lat','job_requests.status_job','users.name','users.email','users.u_phone', 'bookings.date_booking', 'bookings.package','bookings.message')
	                  -> where('job_requests.status_job','Pending')
	                  -> where('job_requests.service', 'Urut Pantang')
	                  ->get();

	           
	   
	          $array = [];
	                    foreach($result as $data){
	                   
	                    $array[] = [
	                                  'job_id'=> $data->job_id,
	                                  'current_status'=> $data->status_job,
	                                  'service' => $data->service,
	                                  'c_name' => $data->name,
	                                  'c_email' => $data->email,
	                                  'c_phone' => $data->u_phone,
	                                  'c_address' => $data->address,
	                                  'c_city' => $data->city,
	                                  'c_postcode' => $data->postcode,
	                                  'c_state' => $data->state,
	                                  'lat' => $data->lat,
	                                  'lng' => $data->lng,
	                                  'message' => $data->message,
	                                  'date_booking'=> $data->date_booking,
	                                  'package' => $data->package
	                                  
	                                ];
	                    
	                    }

	                    return response()->json($array);
	            }

	            else
	              return response()->json(['message' => 'You are not allowed for this process', 'status' => false], 401);


    }
}
