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

class UserController extends Controller
{
    public function viewUser()
    {
         $users = User::all();
         return view('user.index', compact('users'));
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
             return redirect()->route('viewAddUser')->with('flash_message_error', 'Email already exists');
            // we can also  return same page and then displaying in Bootstap Warning Well
            }
        else {
     
         $data = User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => bcrypt($request['password']),
            'role' => $request['role'],
            'status' => $request['status']? 1 : 0,
            ]);
        
         return redirect()->route('viewUser');
       }
  
    }

    public function delete($id)
    {
        User::destroy($id);
        return redirect()->route('viewUser');
    }
}
