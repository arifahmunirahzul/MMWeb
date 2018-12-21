<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Charts\HomeChart;
use App\Booking;
Use App\BitJob;
use DB;
use Auth;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

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
        $user_id = Auth::user()->id;
        $service = Auth::user()->service;
        $chart = new HomeChart;

        $days = $this->generateDateRange(Carbon::now()->subDays(30), Carbon::now());

        $bookings = [];

        $acceptbook = [];

        foreach ($days as $day) {
          $bookings[] = Booking::whereDate('created_at', $day)->count();

          $acceptbook[] = BitJob::whereDate('created_at', $day)->where('status', '=', 'Accept')->count();
        }

        $chart->dataset('Booking','line', $bookings);
        $chart->dataset('Accept Book','line', $acceptbook);
        $chart->labels($days);

        $carbon = Carbon::today();

        $ordertoday = DB:: table('bookings')
                  -> select (DB::raw('count(booking_id) as numberofbooking'))
                  -> where(DB::raw("date(created_at)"), '=', $carbon->format('Y-m-d'))
                  -> get();

        $ordertoday_sp = DB:: table('bit_jobs')
                  -> select (DB::raw('count(bitjob_id) as numberofbook'))
                  -> where('provider_id', $user_id)
                  -> where(DB::raw("date(created_at)"), '=', $carbon->format('Y-m-d'))
                  -> get();

        $salesmonth = DB:: table('bit_jobs')
                  -> select ('price')
                  ->where('status', '=', 'Accept')
                  -> where(DB::raw("month(created_at)"), '=', $carbon->format('m'))
                  -> get();

        $salesmonth_sp = DB:: table('bit_jobs')
                  -> select ('price')
                  -> where('provider_id', $user_id)
                  ->where('status', '=', 'Accept')
                  -> where(DB::raw("month(created_at)"), '=', $carbon->format('m'))
                  -> get();

        $pendingorder = DB:: table('job_requests')
                  -> select (DB::raw('count(job_id) as pendingorders'))
                  -> where('status_job', '=', 'Pending')
                  -> get();

        $pendingorder_sp = DB:: table('job_requests')
                  -> select (DB::raw('count(job_id) as pendingorders'))
                  -> where('status_job', '=', 'Pending')
                  -> where('service', $service)
                  -> get();


        $completedorder = DB:: table('job_requests')
                  -> select (DB::raw('count(job_id) as completedorders'))
                  -> where('status_job', '=', 'Completed')
                  -> get();

        $completedorder_sp = DB:: table('job_requests')
                  -> select (DB::raw('count(job_id) as completedorders'))
                  -> where('status_job', '=', 'Completed')
                  -> where('provider_id', $user_id)
                  -> get();

        $credit_sp = DB::table('users')
                   -> select('credit')
                   -> where('id', $user_id)
                   ->get();

        $latestbook = DB:: table('job_requests')
                  -> select ('booking_id','service','state','city', 'created_at')
                  ->orderBy('created_at', 'desc')
                  ->limit(5)
                  -> get();

        $latestbook_sp = DB:: table('job_requests')
                  -> select ('booking_id','service','state','city', 'created_at')
                  -> where('service', $service)
                  ->orderBy('created_at', 'desc')
                  ->limit(5)
                  -> get();


        return view('home', [
          'chart' => $chart,
          'ordertoday' => $ordertoday,
          'ordertoday_sp' => $ordertoday_sp,
          'salesmonth' => $salesmonth,
          'salesmonth_sp' => $salesmonth_sp,
          'pendingorder' => $pendingorder,
          'pendingorder_sp' => $pendingorder_sp,
          'completedorder' => $completedorder,
          'completedorder_sp' => $completedorder_sp,
          'latestbook' => $latestbook,
          'latestbook_sp' => $latestbook_sp,
          'credit_sp' => $credit_sp

        ]);
    }
}
