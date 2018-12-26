<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Support\Facades\Auth;
use DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\SuccessfullyRegister;

class AuthController extends Controller
{
        public function authenticate(Request $request)
        {
            $credentials = $request->only('email', 'password');
            $email = $request->email;

            try {
                if (! $token = JWTAuth::attempt($credentials)) {
                    return response()->json(['error' => 'invalid_credentials'], 400);
                }
            } catch (JWTException $e) {
                return response()->json(['error' => 'could_not_create_token'], 500);
            }

            return $this->respondWithToken($token,$email);
        }

        public function register(Request $request)
        {
        	if ($request->role =='customer')
		      {
		      	$validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:6|confirmed',
               ]);

		        if($validator->fails()){
                    return response()->json($validator->errors()->toJson(), 400);
		            }

		            $user = User::create([ 
		            	'role' => 'Customer',
		                'name' => $request->get('name'),
		                'email' => $request->get('email'),
		                'password' => Hash::make($request->get('password')),
		            ]);

		            $token = JWTAuth::fromUser($user);
                    $email=$request->email;
                    Mail::to($email)->send(new SuccessfullyRegister ($email));
		            return response()->json(compact('user','token'),201);

		       }

		       else if($request->role =='service provider')
		       {
		       		$validator = Validator::make($request->all(), [
		                'name' => 'required|string|max:255',
		                'email' => 'required|string|email|max:255|unique:users',
		                'password' => 'required|string|min:6|confirmed',
		            ]);

		            if($validator->fails()){
		                    return response()->json($validator->errors()->toJson(), 400);
		            }

		            $user = User::create([
		                'name' => $request->get('name'),
		                'email' => $request->get('email'),
		                'password' => Hash::make($request->get('password')),
		                'role' => 'Service Provider',
			            'approval_status' => 'Pending Approved',
			            'company_name' => $request->get('company_name'),
			            'icnumber' => $request->get('icnumber'),
			            'u_address' => $request->get('u_address'),
			            'u_phone' => $request->get('u_phone'),
			            'service' => $request->get('service'),
		            ]);

		            $token = JWTAuth::fromUser($user);
                    $email=$request->email;
                    Mail::to($email)->send(new SuccessfullyRegister ($email));
		            return response()->json(compact('user','token'),201);
				    }

				else
                   return response()->json(['message' => 'You are not allowed to register', 'status' => false], 401);
                
        }

        public function getAuthenticatedUser()
            {
                    try {

                            if (! $user = JWTAuth::parseToken()->authenticate()) {
                                    return response()->json(['user_not_found'], 404);
                            }

                    } catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {

                            return response()->json(['token_expired'], $e->getStatusCode());

                    } catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {

                            return response()->json(['token_invalid'], $e->getStatusCode());

                    } catch (Tymon\JWTAuth\Exceptions\JWTException $e) {

                            return response()->json(['token_absent'], $e->getStatusCode());

                    }

                    return response()->json(compact('user'));
            }

        protected function respondWithToken($token,$email)
	    {
	      $userid=User::where('email', '=', $email)->value('id');
	      $role=User::where('id', '=', $userid)->value('role');

	      if($role == 'Customer')
	      {
	      		$data = DB:: table('users')
	                -> select ('id','name', 'role','email', 'icnumber', 'u_address', 'u_postcode', 'u_city', 'u_state', 'u_phone', 'url_image')
	                -> where('id',$userid)
	                -> get();
	               
	              return response()->json([
	                    'access_token' => $token,
	                    'token_type' => 'bearer',
	                    'expires_in' => auth('api')->factory()->getTTL() * 60,
	                    'status' => true,
	                    'users' => $data
	                    
	                ]);
	      }

	      else if($role == 'Service Provider')
	      {
	      	     $data = DB:: table('users')
	                -> select ('id','name', 'role','company_name','service','approval_status','email', 'icnumber', 'u_address', 'u_postcode', 'u_city', 'u_state' ,'u_phone', 'url_image')
	                -> where('id',$userid)
	                -> get();
	               
	              return response()->json([
	                    'access_token' => $token,
	                    'token_type' => 'bearer',
	                    'expires_in' => auth('api')->factory()->getTTL() * 60,
	                    'status' => true,
	                    'users' => $data
	                    
	                ]);
	      }

	     }


    /**
     * Log the user out (Invalidate the token)
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        $this->guard()->logout();
        
        return response()->json(['message' => 'Successfully logged out']);
    }

     /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\Guard
     */
    public function guard()
    {
        return Auth::guard('api');
    }


    }