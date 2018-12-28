<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Mail\SuccessfullyRegister; 
use DB;
use App\Booking;
use App\JobRequest;
use App\JobStatus;
use App\User;
use Auth;

class BookController extends Controller
{
    public function viewPembantuRumahList()
    {
    	$pending_pembantu = DB:: table('job_requests')
                  -> join ('bookings', 'bookings.booking_id', '=', 'job_requests.booking_id')
                  -> join ('users', 'users.id', '=', 'bookings.customer_id')
                  -> select ('job_requests.job_id','job_requests.booking_id', 'job_requests.service', 'users.name','users.u_phone' ,'bookings.date_booking','job_requests.status_job', 'bookings.duration', 'bookings.type_property' , 'bookings.clean_area', 'bookings.message' , 'job_requests.address', 'job_requests.city', 'job_requests.postcode', 'job_requests.state' )
                   ->where('job_requests.status_job', '=', 'Pending')
                   ->where('job_requests.service', '=', 'Pembantu Rumah' )
                  -> orderBy('job_requests.job_id','DESC')
                  -> get();

        return view('book.pembantu-rumah', compact('pending_pembantu')); 
    }

    public function viewFormAddPR()
    {
    	$select_name_user = User::getListSelect2();
    	return view('book.add-book-pembantu-rumah',  compact('select_name_user'));
    }

     public function addUserNew(Request $request)
    {
        
        $name = $request->name;

        $email = 'testmm_'.$name.'@gmail.com';
        $password = '123456';
         
        $validator = Validator::make(
        array(

            'email' => $email
        ),
        array(
            'email' => 'required|email|unique:users'
            )
        );
        if ($validator->fails())
           {
           // The given data did not pass validation
             return redirect()->route('viewFormAddPR')->with('flash_message_error', 'Email already exists');
            // we can also  return same page and then displaying in Bootstap Warning Well
            }
        else {
     
         $data = User::create([
            'name' => $request['name'],
            'email' => $email,
            'password' => bcrypt($password),
            'u_phone'=>$request['u_phone'],
            'role' => 'Customer',
            'status' => 1,
            ]);
        
         
         Mail::to($email)->send(new SuccessfullyRegister($email));
         return redirect()->route('viewFormAddPR')->with('flash_message_success', 'Successfully add new record');
      }
        
    }

    public function BookPembantuRumah(Request $request)
    {

    	   $admin_id = Auth::user()->id;

    	     $booking_no = Booking::getNextBookNumber();
           $book = new Booking;
           $book->booking_id = $booking_no;
           $book->adminbook_id = $admin_id;
           $book->customer_id = Input::get('customer_id');
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
           $job_request->service= 'Pembantu Rumah';
           $job_request->status_job = 'Pending';
           $job_request->save();
           JobStatus::CreateStatusJob(); 

           return redirect()->route('viewPembantuRumahList')->with('flash_message_success', 'Successfully make booking');
    }

    public function EditPembantuRumah (Request $request)
    {
    	$booking_id = $request->booking_id;

    	$job_id = DB::table('job_requests')->where('booking_id', '=', $booking_id)->value('job_id');
        
    	  $book = Booking::find($booking_id);
        $book->date_booking = Input::get('date_booking');
        $book->type_service = 'Pembantu Rumah';
        $book->duration = Input::get('duration');
        $book->type_property = Input::get('type_property');
        $book->clean_area = Input::get('clean_area');
        $book->message = Input::get('message');
        $book->save();

        $job_request = JobRequest::find($job_id);
        $job_request->address = Input::get('address');
        $job_request->city = Input::get('city');
        $job_request->postcode = Input::get('postcode');
        $job_request->state = Input::get('state');
        $job_request->save();

        return redirect()->route('viewPembantuRumahList')->with('flash_message_success', 'Data has been updated');


    }

    public function deleteBookPembantuRumah(Request $request)
    {
        $booking_id = $request->booking_id;
    	$job_id = DB::table('job_requests')->where('booking_id', '=', $booking_id)->value('job_id');
        $jobstatus_id = DB::table('job_statuses')->where('job_id', '=', $job_id)->value('jobstatus_id');

        JobStatus::destroy($jobstatus_id);
        JobRequest::destroy($job_id);
        Booking::destroy($booking_id);

        return redirect()->route('viewPembantuRumahList')->with('flash_message_success', 'Successfully delete booking');
    }

    public function viewUrutPantangList()
    {
    	$pending_urut = DB:: table('job_requests')
                  -> join ('bookings', 'bookings.booking_id', '=', 'job_requests.booking_id')
                  -> join ('users', 'users.id', '=', 'bookings.customer_id')
                  -> select ('job_requests.job_id','job_requests.booking_id', 'job_requests.service', 'users.name','users.u_phone' ,'bookings.date_booking','job_requests.status_job', 'bookings.package', 'bookings.type_property' , 'bookings.clean_area', 'bookings.message' , 'job_requests.address', 'job_requests.city', 'job_requests.postcode', 'job_requests.state' )
                   ->where('job_requests.status_job', '=', 'Pending')
                   ->where('job_requests.service', '=', 'Urut Pantang' )
                  -> orderBy('job_requests.job_id','DESC')
                  -> get();

        return view('book.urut-pantang', compact('pending_urut')); 
    }

    public function viewFormAddUP()
    {
    	$select_name_user = User::getListSelect2();
    	return view('book.add-book-urut-pantang',  compact('select_name_user'));
    }

    public function BookUrutPantang(Request $request)
    {

    	   $admin_id = Auth::user()->id;

    	   $booking_no = Booking::getNextBookNumber();
           $book = new Booking;
           $book->booking_id = $booking_no;
           $book->adminbook_id = $admin_id;
           $book->customer_id = Input::get('customer_id');
           $book->date_booking = Input::get('date_booking');
           $book->type_service = 'Urut Pantang';
           $book->package = Input::get('package');
           $book->message = Input::get('message');
           $book->save();

           $job_request = new JobRequest;
           $job_request->booking_id = $booking_no;
           $job_request->address = Input::get('address');
           $job_request->city = Input::get('city');
           $job_request->postcode = Input::get('postcode');
           $job_request->state = Input::get('state');
           $job_request->service= 'Urut Pantang';
           $job_request->status_job = 'Pending';
           $job_request->save();
           JobStatus::CreateStatusJob(); 

           return redirect()->route('viewUrutPantangList')->with('flash_message_success', 'Successfully make booking');
    }

     public function addUserNewUP(Request $request)
    {
        
         $name = $request->name;

        $email = 'testmm_'.$name.'@gmail.com';
        $password = '123456';
         
        $validator = Validator::make(
        array(

            'email' => $email
        ),
        array(
            'email' => 'required|email|unique:users'
            )
        );
        if ($validator->fails())
           {
           // The given data did not pass validation
             return redirect()->route('viewFormAddUP')->with('flash_message_error', 'Email already exists');
            // we can also  return same page and then displaying in Bootstap Warning Well
            }
        else {
     
         $data = User::create([
            'name' => $request['name'],
            'email' => $email,
            'password' => bcrypt($password),
            'u_phone'=>$request['u_phone'],
            'role' => 'Customer',
            'status' => 1,
            ]);
        
         
         Mail::to($email)->send(new SuccessfullyRegister($email));
         return redirect()->route('viewFormAddUP')->with('flash_message_success', 'Successfully add new record');
      }
    }

    public function EditUrutPantang (Request $request)
    {
    	$booking_id = $request->booking_id;

    	$job_id = DB::table('job_requests')->where('booking_id', '=', $booking_id)->value('job_id');

    	$book = Booking::find($booking_id);
        $book->date_booking = Input::get('date_booking');
        $book->type_service = 'Urut Pantang';
        $book->package = Input::get('package');
        $book->message = Input::get('message');
        $book->save();

        $job_request = JobRequest::find($job_id);
        $job_request->address = Input::get('address');
        $job_request->city = Input::get('city');
        $job_request->postcode = Input::get('postcode');
        $job_request->state = Input::get('state');
        $job_request->save();

        return redirect()->route('viewUrutPantangList')->with('flash_message_success', 'Data has been updated');


    }

    public function deleteUrutPantang(Request $request)
    {
        $booking_id = $request->booking_id;
    	  $job_id = DB::table('job_requests')->where('booking_id', '=', $booking_id)->value('job_id');
        $jobstatus_id = DB::table('job_statuses')->where('job_id', '=', $job_id)->value('jobstatus_id');

        JobStatus::destroy($jobstatus_id);
        JobRequest::destroy($job_id);
        Booking::destroy($booking_id);

        return redirect()->route('viewUrutPantangList')->with('flash_message_success', 'Successfully delete booking');
    }

    public function viewKateringList()
    {
      $pending_katering = DB:: table('job_requests')
                  -> join ('bookings', 'bookings.booking_id', '=', 'job_requests.booking_id')
                  -> join ('users', 'users.id', '=', 'bookings.customer_id')
                  -> select ('job_requests.job_id','job_requests.booking_id', 'job_requests.service', 'users.name','users.u_phone' ,'bookings.date_booking','job_requests.status_job', 'bookings.type_event' , 'bookings.total_visitor', 'bookings.message' , 'job_requests.address', 'job_requests.city', 'job_requests.postcode', 'job_requests.state' )
                   ->where('job_requests.status_job', '=', 'Pending')
                   ->where('job_requests.service', '=', 'Katering' )
                  -> orderBy('job_requests.job_id','DESC')
                  -> get();

        return view('book.katering', compact('pending_katering')); 
    }

    public function viewFormAddKatering()
    {
      $select_name_user = User::getListSelect2();
      return view('book.add-book-katering',  compact('select_name_user'));
    }

    public function BookKatering(Request $request)
    {

         $admin_id = Auth::user()->id;

           $booking_no = Booking::getNextBookNumber();
           $book = new Booking;
           $book->booking_id = $booking_no;
           $book->adminbook_id = $admin_id;
           $book->customer_id = Input::get('customer_id');
           $book->date_booking = Input::get('date_booking');
           $book->type_service = 'Katering';
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
           $job_request->service= 'Katering';
           $job_request->status_job = 'Pending';
           $job_request->save();
           JobStatus::CreateStatusJob(); 

           return redirect()->route('viewKateringList')->with('flash_message_success', 'Successfully make booking');
    }

     public function addUserNewKatering(Request $request)
    {
        
        $name = $request->name;

        $email = 'testmm_'.$name.'@gmail.com';
        $password = '123456';
         
        $validator = Validator::make(
        array(

            'email' => $email
        ),
        array(
            'email' => 'required|email|unique:users'
            )
        );
        if ($validator->fails())
           {
           // The given data did not pass validation
             return redirect()->route('viewFormAddKatering')->with('flash_message_error', 'Email already exists');
            // we can also  return same page and then displaying in Bootstap Warning Well
            }
        else {
     
         $data = User::create([
            'name' => $request['name'],
            'email' => $email,
            'password' => bcrypt($password),
            'u_phone'=>$request['u_phone'],
            'role' => 'Customer',
            'status' => 1,
            ]);
        
         
         Mail::to($email)->send(new SuccessfullyRegister($email));
         return redirect()->route('viewFormAddKatering')->with('flash_message_success', 'Successfully add new record');
      }
    }

    public function EditKatering (Request $request)
    {
      $booking_id = $request->booking_id;

      $job_id = DB::table('job_requests')->where('booking_id', '=', $booking_id)->value('job_id');

        $book = Booking::find($booking_id);
        $book->date_booking = Input::get('date_booking');
        $book->type_service = 'Katering';
        $book->total_visitor = Input::get('total_visitor');
        $book->type_event = Input::get('type_event');
        $book->message = Input::get('message');
        $book->save();

        $job_request = JobRequest::find($job_id);
        $job_request->address = Input::get('address');
        $job_request->city = Input::get('city');
        $job_request->postcode = Input::get('postcode');
        $job_request->state = Input::get('state');
        $job_request->save();

        return redirect()->route('viewKateringList')->with('flash_message_success', 'Data has been updated');


    }

    public function deleteKatering(Request $request)
    {
        $booking_id = $request->booking_id;
        $job_id = DB::table('job_requests')->where('booking_id', '=', $booking_id)->value('job_id');
        $jobstatus_id = DB::table('job_statuses')->where('job_id', '=', $job_id)->value('jobstatus_id');

        JobStatus::destroy($jobstatus_id);
        JobRequest::destroy($job_id);
        Booking::destroy($booking_id);

        return redirect()->route('viewKateringList')->with('flash_message_success', 'Successfully delete booking');
    }

}
