<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;

class APIDashboardController extends Controller
{
    public function dashboardview($user_id)
    {
    	
    	$service= DB::table('users')->where('id', '=', $user_id)->value('service');
    	$role= DB::table('users')->where('id', '=', $user_id)->value('role');
        $carbon = Carbon::today();

        if($role == 'Service Provider')
        {


    	$ordertoday_sp = DB:: table('bit_jobs')
                  -> select (DB::raw('count(bitjob_id) as numberofbook'))
                  -> where('provider_id', $user_id)
                  -> where(DB::raw("date(created_at)"), '=', $carbon->format('Y-m-d'))
                  -> get();

        $salesmonth_sp = DB:: table('bit_jobs')
                  -> select (DB::raw('sum(price) as totalsales'))
                  -> where('provider_id', $user_id)
                  ->where('status', '=', 'Accept')
                  -> where(DB::raw("month(created_at)"), '=', $carbon->format('m'))
                  -> get();

        $pendingorder_sp = DB:: table('job_requests')
                  -> select (DB::raw('count(job_id) as pendingorders'))
                  -> where('status_job', '=', 'Pending')
                  -> where('service', $service)
                  -> get();

        $completedorder_sp = DB:: table('job_requests')
                  -> select (DB::raw('count(job_id) as completedorders'))
                  -> where('status_job', '=', 'Completed')
                  -> where('provider_id', $user_id)
                  -> get();

        $latestbook_sp = DB:: table('job_requests')
                  -> select ('booking_id','service','state','city', 'created_at')
                  -> where('service', $service)
                  ->orderBy('created_at', 'desc')
                  ->limit(5)
                  -> get();

         foreach($ordertoday_sp as $data){
             $ordertoday = $data->numberofbook;
         }

         foreach( $salesmonth_sp as $data){
             $sale = $data->totalsales;
         }

         foreach($pendingorder_sp as $data){
             $pendingorder = $data->pendingorders;
         }

         foreach($completedorder_sp as $data){
             $completeorder = $data->completedorders;
         }

         return response()->json([
    		'status' => true,
        	'ordertoday' => $ordertoday,
        	'totalsales' => $sale,
        	'pendingorder' => $pendingorder,
        	'completeorder' => $completeorder,
        	'latestbook_sp' => $latestbook_sp

        ]);

        }

        else
        	return response()->json(['message' => 'You are not allowed for this process', 'status' => false], 401);

    }
}
