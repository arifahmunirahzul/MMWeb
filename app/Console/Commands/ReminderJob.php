<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use DB;
use Mail;
use App\Mail\JobReminder;
use App\Mail\ReminderCustomer;

class ReminderJob extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reminder:job';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send email for reminder job task';

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
        $booking_id = DB::table('bookings')
                ->select('booking_id')
                ->whereRaw('date_booking = CURDATE()')
                ->value('booking_id');

        $date_booking = DB::table('bookings')
                ->select('date_booking')
                ->whereRaw('date_booking = CURDATE()')
                ->value('date_booking');

        $customer_id = DB::table('bookings')
                ->select('customer_id')
                ->where('booking_id', '=', $booking_id)
                ->value('customer_id');

        $provider_id = DB::table('job_requests')
                     ->select('provider_id')
                     ->where('booking_id', '=', $booking_id)
                     ->value('provider_id');

        $spemail = DB::table('users')->select('email')->where('id', '=',$provider_id)->get();

        $cust_email = DB::table('users')->select('email')->where('id', '=',$customer_id)->get();

        $cust_name = DB::table('users')->select('name')->where('id', '=',$customer_id)->value('name');

        $book = DB::table('bookings')
                ->join('job_requests','job_requests.booking_id', '=', 'bookings.booking_id')
                ->join('users','users.id', '=', 'job_requests.provider_id')
                ->select('users.name', 'users.u_phone','bookings.type_service', 'bookings.date_booking', 'bookings.duration', 'bookings.type_property', 'bookings.clean_area','bookings.package', 'bookings.total_visitor', 'bookings.type_event', 'bookings.message', 'job_requests.address', 'job_requests.postcode', 'job_requests.city', 'job_requests.state')
                ->where('bookings.booking_id', '=',$booking_id)
                ->get();


        $data = [
                 'email'          => $spemail->pluck('email')->toArray(),
                 'date_booking'   => $date_booking,
                 'booking_id'     => $booking_id,
              ];

        Mail::send('emails.reminder', $data, function($m) use ($data){
                 $m->to($data['email'], '')->subject('Job Notifications Alert');
              });

        $data1 = [
                 'email'          => $cust_email ->pluck('email')->toArray(),
                 'cust_name'      => $cust_name,
                 'date_booking'   => $date_booking,
                 'booking_id'     => $booking_id,
                 'book'           => $book,
              ];

        Mail::send('emails.reminder-customer', $data1, function($m) use ($data1){
                 $m->to($data1['email'], '')->subject('Notifications Alert');
              });

    }
}
