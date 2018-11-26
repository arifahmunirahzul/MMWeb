<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Charts\DashboardChart;
use App\Booking;
use Carbon\Carbon;
use DB;
use Auth;

class DashboardController extends Controller
{
	private function generateDateRange(Carbon $start_date, Carbon $end_date)
	{
	      $dates = [];

	      for ($date = $start_date; $date->lte($end_date); $date->addDay()){
	        $dates[]= $date->format('Y-m-d');
	}

	      return $dates;
	}

    public function index()
    {

	    $chart = new DashboardChart;

        $days = $this->generateDateRange(Carbon::now()->subDays(30), Carbon::now());

        $bookings = [];

        foreach ($days as $day) {
          $bookings[] = Booking::whereDate('created_at', $day)->count();
        }

        $chart->dataset('Booking','line', $bookings);
        $chart->labels($days);

    	  $carbon = Carbon::today();
        $ordertoday = DB:: table('bookings')
                  -> select (DB::raw('count(booking_id) as numberofbooking'))
                  -> where(DB::raw("date(created_at)"), '=', $carbon->format('Y-m-d'))
                  -> get();

        $salesmonth = DB:: table('bit_jobs')
                  -> select ('price')
                  ->where('status', '=', 'Accept')
                  -> where(DB::raw("month(created_at)"), '=', $carbon->format('m'))
                  -> get();

        $pendingorder = DB:: table('job_requests')
                  -> select (DB::raw('count(job_id) as pendingorders'))
                  -> where('status_job', '=', 'Pending')
                  -> get();

        $completedorder = DB:: table('job_requests')
                  -> select (DB::raw('count(job_id) as completedorders'))
                  -> where('status_job', '=', 'Completed')
                  -> get();

        $latestbook = DB:: table('job_requests')
                  -> select ('booking_id','service','state','city', 'created_at')
                  ->orderBy('created_at', 'desc')
                  ->limit(5)
                  -> get();

        return view('dashboard', [
          'chart' => $chart,
          'ordertoday' => $ordertoday,
          'salesmonth' => $salesmonth,
          'pendingorder' => $pendingorder,
          'completedorder' => $completedorder,
          'latestbook' => $latestbook

        ]);
    }
}
