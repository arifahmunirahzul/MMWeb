<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\JobStatus;
use App\JobRequest;
use App\Booking;
use DB;

class APIBookController extends Controller
{
    public function BookUrutPantang(Request $request, $customer_id) {

      $role = DB::table('users')->where('id', '=', $customer_id)->value('role');
      
      if($role == 'Customer'){

         $booking_no = Booking::getNextBookNumber();
         $book = new Booking;
           $book->booking_id = $booking_no;
           $book->customer_id = $customer_id;
           $book->type_service = 'Urut Pantang';
           $book->date_booking = Input::get('date_booking');
           $book->package = Input::get('package');
           $book->message = Input::get('message');
           $book->save();

         $job_request = new JobRequest;
           $job_request->booking_id = $booking_no;
           $job_request->address = Input::get('address');
           $job_request->city = Input::get('city');
           $job_request->postcode = Input::get('postcode');
           $job_request->state = Input::get('state');
           $job_request->lng = Input::get('lng');
           $job_request->lat = Input::get('lat');
           $job_request->service= 'Urut Pantang';
           $job_request->status_job = 'Pending';
           $job_request->save();
           JobStatus::CreateStatusJob();

           return response()->json(['booking_id'=> $booking_no,'message' => 'Successful Booking Service', 'status' => true], 201);

       }//end if

       else
        return response()->json(['message' => 'You are not allowed for this process', 'status' => false], 401);


    }


    public function BookKatering(Request $request, $customer_id) {

      $role = DB::table('users')->where('id', '=', $customer_id)->value('role');
      
      if($role == 'Customer'){

           $booking_no = Booking::getNextBookNumber();
           $book = new Booking;
           $book->booking_id = $booking_no;
           $book->customer_id = $customer_id;
           $book->type_service = 'Katering';
           $book->date_booking = Input::get('date_booking');
           $book->total_visitor = Input::get('total_visitor');
           $book->type_event = Input::get('type_event');
           $book->message = Input::get('message');
           $book->save();

           $job_request = new JobRequest;
           $job_request->booking_id = $booking_no;
           $job_request->address = Input::get('address');
           $job_request->city = Input::get('city');
           $job_request->postcode = Input::get('postcode');
           $job_request->state = Input::get('state');
           $job_request->lng = Input::get('lng');
           $job_request->lat = Input::get('lat');
           $job_request->service= 'Katering';
           $job_request->status_job = 'Pending';
           $job_request->save();
           JobStatus::CreateStatusJob();

           return response()->json(['booking_id'=> $booking_no,'message' => 'Successful Booking Service', 'status' => true], 201);

       }//end if

       else
        return response()->json(['message' => 'You are not allowed for this process', 'status' => false], 401);


    }

    public function BookPembantuRumah(Request $request, $customer_id) {

      $role = DB::table('users')->where('id', '=', $customer_id)->value('role');
      
      if($role == 'Customer'){

           $booking_no = Booking::getNextBookNumber();
           $book = new Booking;
           $book->booking_id = $booking_no;
           $book->customer_id = $customer_id;
           $book->date_booking = Input::get('date_booking');
           $book->type_service = 'Pembantu Rumah';
           $book->duration = Input::get('duration');
           $book->type_property = Input::get('type_property');
           $book->clean_area = Input::get('clean_area');
           $book->message = Input::get('message');
           $book->save();

           $job_request = new JobRequest;
           $job_request->booking_id = $booking_no;
           $job_request->address = Input::get('address');
           $job_request->city = Input::get('city');
           $job_request->postcode = Input::get('postcode');
           $job_request->state = Input::get('state');
           $job_request->lng = Input::get('lng');
           $job_request->lat = Input::get('lat');
           $job_request->service= 'Pembantu Rumah';
           $job_request->status_job = 'Pending';
           $job_request->save();
           JobStatus::CreateStatusJob();

           return response()->json(['booking_id'=> $booking_no,'message' => 'Successful Booking Service', 'status' => true], 201);

       }//end if

       else
        return response()->json(['message' => 'You are not allowed for this process', 'status' => false], 401);


    }
}
