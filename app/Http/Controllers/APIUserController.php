<?php

namespace App\Http\Controllers;

use App\User;
use App\StoreLocation;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class APIUserController extends Controller
{

	public function viewProfile($id)
    {
        $role = DB::table('users')->where('id', '=', $id)->value('role');

        if($role == 'Service Provider')
        {
            $user = DB:: table('users')
                  -> select ('id', 'playerId', 'name','email', 'icnumber', 'u_address','u_postcode', 'u_city', 'u_state','url_image', 'u_bankname', 'u_accnumber', 'u_phone', 'role', 'service', 'commission', 'approval_status', 'about_me')
                  ->where('id', $id)
                  -> get();

           
            $array = [];
            foreach($user as $data){       
                        $array[] = [
                                      'id'=> $data->id,
                                      'playerId'=> $data->playerId,
                                      'name' => $data->name,
                                      'email' => $data->email,
                                      'icnumber' => $data->icnumber,
                                      'u_address' => $data->u_address,
                                      'u_postcode' => $data->u_postcode,
                                      'u_city'  => $data->u_city,
                                      'u_state' => $data->u_state,
                                      'url_image' => $data->url_image,
                                      'u_bankname' => $data->u_bankname,
                                      'u_accnumber' => $data->u_accnumber,
                                      'u_phone' => $data->u_phone,
                                      'role' => $data->role,
                                      'service' => $data->service,
                                      'approval_status' => $data->approval_status,
                                      'commission' => $data->commission,
                                      'about_me' => $data->about_me

                                    ];
                        
                        }
           
            return response() -> json($array);
        }

        else if ($role == 'Customer'){

            $user = DB:: table('users')
                  -> select ('id', 'playerId', 'name','email', 'icnumber', 'u_address','u_postcode', 'u_city', 'u_state','url_image', 'u_bankname', 'u_accnumber', 'u_phone', 'role', 'about_me')
                  ->where('id', $id)
                  -> get();

           
            $array = [];
            foreach($user as $data){       
                        $array[] = [
                                      'id'=> $data->id,
                                      'playerId'=> $data->playerId,
                                      'name' => $data->name,
                                      'email' => $data->email,
                                      'icnumber' => $data->icnumber,
                                      'u_postcode' => $data->u_postcode,
                                      'u_city'  => $data->u_city,
                                      'u_state' => $data->u_state,
                                      'url_image' => $data->url_image,
                                      'u_bankname' => $data->u_bankname,
                                      'u_accnumber' => $data->u_accnumber,
                                      'u_phone' => $data->u_phone,
                                      'role' => $data->role,
                                      'about_me' => $data->about_me

                                    ];
                        
                        }
            
            return response() -> json($array);
        }

        else{
            return response()->json(['message' => 'Failed to proceed a process', 'status' => false], 401);	
        }

    } //end public    

    public function UserProfile(Request $request, $id) {
        
    $role = DB::table('users')->where('id', '=', $id)->value('role');
            
        if($role == 'Service Provider'){
            
            $input = $request->all();
            
            $user = User::find($id);
            $user->update($input);
            $user->save();

             
            return response()->json(['message' => 'Your Profile has been updated', 'status' => true], 201);
        } //end if

        else if($role == 'Customer'){

              $input = $request->all();
                
              $user = User::find($id);
              $user->update($input);
              $user->save();

              return response()->json(['message' => 'Your Profile has been updated', 'status' => true], 201);
        } //end else if

        else{
        	return response()->json(['message' => 'Failed to proceed a process', 'status' => false], 401);
        }

        
    } //end public

    public function ChangePassword(Request $request, $id){
        $user = User::find($id);
         if (Input::get('password') != '')
            $user->password = bcrypt(Input::get('password'));
            $user->save();
            return response()->json(['message' => 'Password has been change', 'status' => true], 201);
    } //end public


    public function UserImage (Request $request, $id){

        if($request != ''){
        $user = User::find($id);
        //upload new images
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

        $user->url_image = $filename;
        $user->save();

        $urlimage = DB::table('users')->where('id', '=', $id)->value('url_image');

        return response()->json(['message' => 'Image has been update', 'url_image' => $urlimage, 'status' => true], 201);
        }

        else
          return response()->json(['message' => 'Failed to update Image', 'status' => false], 401);

    }//end public

    public function SavePalyerId(Request $request, $id) {
        
        if ($request->playerId != ''){
            $user = User::find($id);
            $user->playerId = Input::get('playerId');
            $user->save();
            return response()->json(['message' => 'Player Id has been saved', 'status' => true], 201);
        }

        else
           return response()->json(['message' => 'Failed to saved Player Id', 'status' => false], 401); 
       
    } //end public
}
