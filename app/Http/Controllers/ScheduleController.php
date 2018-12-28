<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Booking;
use Calendar;
use Carbon\Carbon;

class ScheduleController extends Controller
{
    public function viewTaskPembantuRumah() 
    {

        $events = [];
        $data = DB::table('bookings')
                -> join ('job_requests', 'job_requests.booking_id', '=', 'bookings.booking_id')
                -> join ('users', 'users.id', '=', 'job_requests.provider_id')
                -> select ('bookings.booking_id', 'users.name', 'bookings.date_booking', 'bookings.type_service', 'job_requests.city')
                ->where('bookings.type_service', '=', 'Pembantu Rumah' )
                ->where('job_requests.status_job', '=', 'Active' )
                -> get();

        if($data->count()) {
            foreach ($data as $key => $value) {
                $colour = Booking::getColor($value->date_booking);
                $events[] = Calendar::event(
                    $value->name,
                    true,
                    new \DateTime($value->date_booking),
                    new \DateTime($value->date_booking.' +1 day'),
                    null,
                    // Add color and link on event
                    [
                       
                        'color' => $colour,
                        'url' => '/mobilemuslim.com/public/view-schedule-details/'.$value->booking_id,
                    ]
                );
            }
        }
        $calendar = Calendar::addEvents($events);

        return view('schedule.task-pembantu-rumah', [
          'calendar' => $calendar
          
        ]);
        
        
    }


    public function viewTaskUrutPantang()
    {
        
        $events = [];
        $data = DB::table('bookings')
                -> join ('job_requests', 'job_requests.booking_id', '=', 'bookings.booking_id')
                -> join ('users', 'users.id', '=', 'job_requests.provider_id')
                -> select ('bookings.booking_id', 'users.name', 'bookings.date_booking', 'bookings.type_service', 'job_requests.city')
                ->where('bookings.type_service', '=', 'Urut Pantang' )
                ->where('job_requests.status_job', '=', 'Active' )
                -> get();

        if($data->count()) {
            foreach ($data as $key => $value) {
                $date_booking = $value->date_booking;
                $colour = Booking::getColor($date_booking);
                $events[] = Calendar::event(
                    $value->name,
                    true,
                    new \DateTime($value->date_booking),
                    new \DateTime($value->date_booking.' +1 day'),
                    null,
                    // Add color and link on event
                    [
                        'color' => $colour,
                        'url' => '/mobilemuslim.com/public/view-schedule-details/'.$value->booking_id,
                    ]
                );
            }
        }
        $calendar = Calendar::addEvents($events);

        return view('schedule.task-urut-pantang', [
          'calendar' => $calendar
          
        ]);
    }

     public function viewTaskKatering()
    {
        
        $events = [];
        $data = DB::table('bookings')
                -> join ('job_requests', 'job_requests.booking_id', '=', 'bookings.booking_id')
                -> join ('users', 'users.id', '=', 'job_requests.provider_id')
                -> select ('bookings.booking_id', 'users.name', 'bookings.date_booking', 'bookings.type_service', 'job_requests.city')
                ->where('bookings.type_service', '=', 'Katering' )
                ->where('job_requests.status_job', '=', 'Active' )
                -> get();

        if($data->count()) {
            foreach ($data as $key => $value) {
                $colour = Booking::getColor($value->date_booking);
                $events[] = Calendar::event(
                    $value->name,
                    true,
                    new \DateTime($value->date_booking),
                    new \DateTime($value->date_booking.' +1 day'),
                    null,
                    // Add color and link on event
                    [
                        'color' => $colour,
                        'url' => '/mobilemuslim.com/public/view-schedule-details/'.$value->booking_id,
                    ]
                );
            }
        }
        $calendar = Calendar::addEvents($events);

        return view('schedule.task-katering', [
          'calendar' => $calendar
          
        ]);
    }
}
