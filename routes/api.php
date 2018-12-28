<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {
    
    Route::post('register', 'AuthController@register');
    Route::post('login', 'AuthController@authenticate');
    Route::post('forgot/password', 'Auth\ForgotPasswordController');

});

Route::group([

    'middleware' => 'jwt.verify',
    'prefix' => 'auth'

], function ($router) {
    
;
    Route::post('logout', 'AuthController@logout');
    

});

Route::group([

    'middleware' => 'jwt.verify',
    'prefix' => 'users'

], function ($router) {

    Route::get('view-profile/{id}', 'APIUserController@viewProfile');
    Route::post('update-profile/{id}', 'APIUserController@UserProfile');
    Route::post('change-password/{id}', 'APIUserController@ChangePassword');
    Route::post('user-image/{id}', 'APIUserController@UserImage');
    Route::post('user-save-playerId/{id}', 'APIUserController@SavePalyerId');
      
});

Route::group([

    'middleware' => 'jwt.verify',
    'prefix' => 'request-service'

], function ($router) {

    Route::post('urut-pantang/{customer_id}', 'APIBookController@BookUrutPantang');
    Route::post('katering/{customer_id}', 'APIBookController@BookKatering');
    Route::post('pembantu-rumah/{customer_id}', 'APIBookController@BookPembantuRumah');
      
});

Route::group([

    'middleware' => 'jwt.verify',
    'prefix' => 'customer'

], function ($router) {

    Route::get('view-list-booking/{customer_id}', 'APIBitJobController@ViewListBooking');
      
});



Route::group([

    'middleware' => 'jwt.verify',
    'prefix' => 'job-request'

], function ($router) {

    Route::get('pending/{provider_id}', 'APIJobRequestController@PendingJobRequests');
    Route::get('customer-list/{customer_id}', 'APIJobRequestController@CustomerBookList');
      
});



Route::group([

    'middleware' => 'jwt.verify',
    'prefix' => 'bit-job'

], function ($router) {

    Route::post('submit-quotation/{job_id}', 'APIBitJobController@SubmitQuotation');
      
});

Route::group([

    'middleware' => 'jwt.verify',
    'prefix' => 'quotation'

], function ($router) {

    Route::post('view-quotation/{job_id}', 'APIBitJobController@ViewQuotation');
    Route::post('confirm-quotation/{job_id}', 'APIBitJobController@ConfirmQuotation');
      
});

Route::group([

    'middleware' => 'jwt.verify',
    'prefix' => 'dashboard'

], function ($router) {

    Route::get('service-provider-view/{user_id}', 'APIDashboardController@dashboardview');     
});

Route::group([

    'middleware' => 'api',
    'prefix' => 'face_id'

], function ($router) {

    Route::post('upload-image', 'APIImageController@UploadImage');     
});



