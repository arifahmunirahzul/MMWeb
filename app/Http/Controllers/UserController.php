<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use DB;
use Illuminate\Support\Facades\Storage;
use App\StoreLocation;
use Illuminate\Support\Facades\Mail;
use App\Mail\SuccessfullyRegister; 

class UserController extends Controller
{
    public function viewUser()
    {
         $users = User::all();
         return view('user.index', compact('users'));
    }

    public function viewPendingApprovalUser()
    {
         $pendinguser = DB:: table('users')
                  -> select ('id','name','email', 'role')
                  ->where('approval_status', 'Pending Approval')
                  -> orderBy('created_at','DESC')
                  -> get();
         return view('user.pending-approval', compact('pendinguser'));
    }

    public function viewAddUser()
    {
        
        return view('user.add');
    }

    public function viewProfile()
    {
        $id = Auth::user()->id;
        $data = User::getSingleData($id);
        return view('user.profile', [
            'data' => $data

        ]);
    }

    public function viewEditProfile()
    {
        $id = Auth::user()->id;
        $data = User::getSingleData($id);
        return view('user.edit-profile', [
            'data' => $data

        ]);
    }
 
    public function viewUserProfile($id)
    {
        $data = User::getSingleData($id);
        return view('user.view_user', [
            'data' => $data

        ]);
    }

    public function editUserProfile(Request $request, $id) {



        $role = DB::table('users')->where('id', '=', $id)->value('role'); 
        
        if($role == 'Service Provider'){
            $user = User::find($id);
            if (Input::get('password') != '')
                $user->password = bcrypt(Input::get('password'));
            if ($request->hasFile('url_image'))
                {
                $file = $request->file('url_image');
                $filename = time() . str_random(5) . '_' . $user->id . '.' . $file->getClientOriginalExtension();
                $path = 'upload/userpic';
                $file->move($path, $filename);
                $oldFilename = $user->url_image;

                //delete oldpicture
                Storage::disk('public')->delete("upload/userpic/$oldFilename");
                }

                else{
                    $filename=$user->url_image;
                }

            $user->service = Input::get('service');
            $user->company_name = Input::get('company_name');
            $user->name = Input::get('name');
            $user->email = Input::get('email');
            $user->icnumber = Input::get('icnumber');
            $user->u_address = Input::get('u_address');
            $user->u_city = Input::get('u_city');
            $user->u_postcode = Input::get('u_postcode');
            $user->u_state = Input::get('u_state');
            $user->u_phone = Input::get('u_phone');
            $user->about_me = Input::get('about_me');
            $user->url_image = $filename;
            $user->save();
            return redirect()->route('viewEditProfile');
        }

        else if ($role == 'Admin' or $role == 'Customer'){
            $user = User::find($id);
            if (Input::get('password') != '')
                $user->password = bcrypt(Input::get('password'));
            if ($request->hasFile('url_image'))
                {
                $file = $request->file('url_image');
                $filename = time() . str_random(5) . '_' . $user->id . '.' . $file->getClientOriginalExtension();
                $path = 'upload/userpic';
                $file->move($path, $filename);
                $oldFilename = $user->url_image;

                //delete oldpicture
                Storage::disk('public')->delete("upload/userpic/$oldFilename");
                }

                else{
                    $filename=$user->url_image;
                }

            $user->name = Input::get('name');
            $user->email = Input::get('email');
            $user->icnumber = Input::get('icnumber');
            $user->u_address = Input::get('u_address');
            $user->u_city = Input::get('u_city');
            $user->u_postcode = Input::get('u_postcode');
            $user->u_state = Input::get('u_state');
            $user->u_phone = Input::get('u_phone');
            $user->about_me = Input::get('about_me');
            $user->url_image = $filename;
            $user->save();
            return redirect()->route('viewEditProfile');
        }
        
    }

    public function viewEdit($id)
    {
        
        $data = User::getSingleData($id);

         return view('user.edit', [
            'data' => $data

        ]);
    }

    public function viewEditPA($id)
    {
        
        $data = User::getSingleData($id);

         return view('user.editPA', [
            'data' => $data

        ]);
    }

    public function viewApprove($id)
    {
        $data = User::getSingleData($id);

        return view('user.app-commission', [
            'data' => $data

        ]);
    }

    public function ApproveSP(Request $request, $id){
        
        $user = User::find($id);
        $user->approval_status = Input::get('approval_status');
        $user->commission = Input::get('commission')/100;
        $user->credit = 200.00;
        $user->save();
        return redirect()->route('viewUser');
    }

    public function editUser(Request $request, $id) {

        $role = DB::table('users')->where('id', '=', $id)->value('role'); 
        
        if($role == 'Service Provider'){
            $user = User::find($id);
            if (Input::get('password') != '')
                $user->password = bcrypt(Input::get('password'));
            if ($request->hasFile('url_image'))
                {
                $file = $request->file('url_image');
                $filename = time() . str_random(5) . '_' . $user->id . '.' . $file->getClientOriginalExtension();
                $path = 'upload/userpic';
                $file->move($path, $filename);
                $oldFilename = $user->url_image;

                //delete oldpicture
                Storage::disk('public')->delete("upload/userpic/$oldFilename");
                }

                else{
                    $filename=$user->url_image;
                }

            $user->service = Input::get('service');
            $user->company_name = Input::get('company_name');
            $user->name = Input::get('name');
            $user->commission = Input::get('commission')/100;
            $user->email = Input::get('email');
            $user->icnumber = Input::get('icnumber');
            $user->u_address = Input::get('u_address');
            $user->u_city = Input::get('u_city');
            $user->u_postcode = Input::get('u_postcode');
            $user->u_state = Input::get('u_state');
            $user->u_phone = Input::get('u_phone');
            $user->about_me = Input::get('about_me');
            $user->url_image = $filename;
            $user->save();
            return redirect()->route('viewUser');
        }

        else if ($role == 'Admin' or $role == 'Customer'){
            $user = User::find($id);
            if (Input::get('password') != '')
                $user->password = bcrypt(Input::get('password'));
            if ($request->hasFile('url_image'))
                {
                $file = $request->file('url_image');
                $filename = time() . str_random(5) . '_' . $user->id . '.' . $file->getClientOriginalExtension();
                $path = 'upload/userpic';
                $file->move($path, $filename);
                $oldFilename = $user->url_image;

                //delete oldpicture
                Storage::disk('public')->delete("upload/userpic/$oldFilename");
                }

                else{
                    $filename=$user->url_image;
                }

            $user->name = Input::get('name');
            $user->email = Input::get('email');
            $user->icnumber = Input::get('icnumber');
            $user->u_address = Input::get('u_address');
            $user->u_city = Input::get('u_city');
            $user->u_postcode = Input::get('u_postcode');
            $user->u_state = Input::get('u_state');
            $user->u_phone = Input::get('u_phone');
            $user->about_me = Input::get('about_me');
            $user->url_image = $filename;
            $user->save();
            return redirect()->route('viewUser');
        }
        
    }

    public function addUser(Request $request)
    {
        
         $email = Input::get('email');

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
             return redirect()->route('viewUser')->with('flash_message_error', 'Email already exists');
            // we can also  return same page and then displaying in Bootstap Warning Well
            }
        else {
     
         $data = User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => bcrypt($request['password']),
            'u_phone'=>$request['u_phone'],
            'role' => $request['role'],
            'status' => $request['status']? 1 : 0,
            ]);
        
         $email = $request->email;;
         Mail::to($email)->send(new SuccessfullyRegister($email));
         return redirect()->route('viewUser')->with('flash_message_success', 'Successfully add new record');
       }
  
    }

    public function delete(Request $request)
    {
        User::destroy($request->id);
        return redirect()->route('viewUser');
    }

    public function addCredit(Request $request)
    {
        $user_id = $request->id;
        $current_credit = DB::table('users')->where('id', '=', $user_id)->value('credit'); 
        $new_credit = $request->credit;

        $addcredit = User::find($user_id);
        $addcredit->credit = $current_credit + $new_credit;
        $addcredit->save();
        return redirect()->route('viewUser')->with('flash_message_success', 'Credit amount has been added');
    }
}
