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
}
