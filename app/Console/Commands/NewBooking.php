<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use DB;
use Mail;
use App\Mail\NewBookingAlert;

class NewBooking extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'booking:newbook';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send email for new booking request alert';

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
        $newbooktotal = DB::table('bookings')
                      ->whereRaw('Date(created_at) = CURDATE()')
                      ->count();

        $SPemail = DB::table('users')->select('email')->where('role', '=', 'Service Provider')->get();

               $data1 = [
                 'email'          => $SPemail->pluck('email')->toArray(),
              ];

        Mail::to($data1['email'])->send(new NewBookingAlert($newbooktotal));


    }
}
