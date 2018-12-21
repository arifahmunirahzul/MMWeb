<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Calendar;

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
                $events[] = Calendar::event(
                    $value->name,
                    true,
                    new \DateTime($value->date_booking),
                    new \DateTime($value->date_booking.' +1 day'),
                    null,
                    // Add color and link on event
                    [
                        'color' => '#ffbf80',
                        'url' => 'pass here url and any route',
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
                $events[] = Calendar::event(
                    $value->name,
                    true,
                    new \DateTime($value->date_booking),
                    new \DateTime($value->date_booking.' +1 day'),
                    null,
                    // Add color and link on event
                    [
                        'color' => '#d9b3ff',
                        'url' => 'pass here url and any route',
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
                $events[] = Calendar::event(
                    $value->name,
                    true,
                    new \DateTime($value->date_booking),
                    new \DateTime($value->date_booking.' +1 day'),
                    null,
                    // Add color and link on event
                    [
                        'color' => '#8cd9b3',
                        'url' => 'pass here url and any route',
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
