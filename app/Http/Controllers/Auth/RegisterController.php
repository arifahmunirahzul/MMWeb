<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\TypeService;
use Illuminate\Support\Facades\Mail;
use App\Mail\Welcome;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'icnumber' =>'required|string|max:12',
            'u_address' => 'required|string|max:500',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => 'Service Provider',
            'approval_status' => 'Pending Approved',
            'company_name' => $data['company_name'],
            'icnumber' => $data['icnumber'],
            'u_address' => $data['u_address'],
            'u_city' => $data['u_city'],
            'u_postcode' => $data['u_postcode'],
            'u_state' => $data['u_state'],
            'u_phone' =>$data['u_phone'],
            'service' => $data['service']

        ]);

        $email = $data['email'];
        Mail::to($email)->send(new Welcome($email));
    }

    protected function createuser(Request $request)
    {

      if ($request->role =='customer')
      {
        User::create([
        'role' => 'Customer',
        'name' => $request->name,
        'email' => $request->email,
        'password' => bcrypt($request->password),
        ]);

        $email = $request->email;
        Mail::to($email)->send(new Welcome($email));

        return response()->json(['message' => 'Successfully Register', 'status' => true], 201);
       }

       else if ($request->role =='service provider')
       {
         User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => 'Service Provider',
            'approval_status' => 'Pending Approved',
            'company_name' => $request->company_name,
            'icnumber' => $request->icnumber,
            'u_address' => $request->u_address,
            'u_city' => $request->u_city,
            'u_postcode' => $request->u_postcode,
            'u_state' => $request->u_state,
            'u_phone' => $request->u_phone,
            'service' => $request->service


        ]);

        $email = $request->email;
        Mail::to($email)->send(new Welcome($email));

         return response()->json(['message' => 'Successfully Register', 'status' => true], 201);
       }

       else
         return response()->json(['message' => 'You are not allowed to register', 'status' => false], 401);
        
    }
}
