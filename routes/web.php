<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::group(['middleware' => 'auth'], function () {
    Route::get('/', function () {
        if (Auth::user()->role == 'Service Provider')
            {
                return redirect('/home');
                
            }
        else if (Auth::user()->role == 'Admin')
            {
                return redirect('/home');
            }

        else
            return redirect('/logout');
    });

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
Route::get('/user', ['as' => 'viewUser','uses' => 'UserController@viewUser']);
Route::get('/user/viewadd', ['as' => 'viewAddUser','uses' => 'UserController@viewAddUser']);
Route::get('/profile', ['as' => 'viewProfile','uses' => 'UserController@viewProfile']);
Route::get('/pending-approval', ['as' => 'viewPendingApprovalUser','uses' => 'UserController@viewPendingApprovalUser']);
Route::get('/pending-approval/edit/{id}', ['as' => 'viewEditPA','uses' => 'UserController@viewEditPA']);
Route::get('/user/edit/{id}', ['as' => 'viewEdit','uses' => 'UserController@viewEdit']);
Route::get('/view-edit-profile', ['as' => 'viewEditProfile','uses' => 'UserController@viewEditProfile']);
Route::post('/editprofile-save/{id}', ['uses' => 'UserController@editUserProfile','as' => 'editUserProfile']);
Route::get('user/view-profile/{id}', ['as' => 'viewUserProfile','uses' => 'UserController@viewUserProfile']);
Route::post('/user/edit-save/{id}', ['uses' => 'UserController@editUser','as' => 'editUser']);
Route::post('/user/add', ['as' => 'addUser','uses' => 'UserController@addUser']);
Route::post('/user/add-credit', ['as' => 'addCredit','uses' => 'UserController@addCredit']);
Route::delete('/user/delete', ['uses' => 'UserController@delete','as' => 'delete']);
Route::get('/user/view-approve/{id}', ['as' => 'viewApprove','uses' => 'UserController@viewApprove']);
Route::post('/user/save-approve/{id}', ['uses' => 'UserController@ApproveSP','as' => 'ApproveSP']);
Route::get('/logout', function(){Auth::logout(); return Redirect::to('/login');
    });

Route::get('/view-book-pembantu-rumah', ['as' => 'viewPembantuRumahList','uses' => 'BookController@viewPembantuRumahList']);
Route::get('/view-form-add-pr', ['as' => 'viewFormAddPR','uses' => 'BookController@viewFormAddPR']);
Route::post('/add-new-user', ['as' => 'addUserNew','uses' => 'BookController@addUserNew']);
Route::post('/add-book-pembantu-rumah', ['as' => 'BookPembantuRumah','uses' => 'BookController@BookPembantuRumah']);
Route::post('/edit-book-pembantu-rumah', ['as' => 'EditPembantuRumah','uses' => 'BookController@EditPembantuRumah']);
Route::delete('/delete-book-pembantu-rumah', ['uses' => 'BookController@deleteBookPembantuRumah','as' => 'deleteBookPembantuRumah']);

Route::get('/view-book-urut-pantang', ['as' => 'viewUrutPantangList','uses' => 'BookController@viewUrutPantangList']);
Route::get('/view-form-add-up', ['as' => 'viewFormAddUP','uses' => 'BookController@viewFormAddUP']);
Route::post('/add-new-user-up', ['as' => 'addUserNewUP','uses' => 'BookController@addUserNewUP']);
Route::post('/add-book-urut-pantang', ['as' => 'BookUrutPantang','uses' => 'BookController@BookUrutPantang']);
Route::post('/edit-book-urut-pantang', ['as' => 'EditUrutPantang','uses' => 'BookController@EditUrutPantang']);
Route::delete('/delete-book-urut-pantang', ['uses' => 'BookController@deleteUrutPantang','as' => 'deleteUrutPantang']);

Route::get('/view-book-katering', ['as' => 'viewKateringList','uses' => 'BookController@viewKateringList']);
Route::get('/view-form-add-katering', ['as' => 'viewFormAddKatering','uses' => 'BookController@viewFormAddKatering']);
Route::post('/add-new-user-katering', ['as' => 'addUserNewKatering','uses' => 'BookController@addUserNewKatering']);
Route::post('/add-book-katering', ['as' => 'BookKatering','uses' => 'BookController@BookKatering']);
Route::post('/edit-book-katering', ['as' => 'EditKatering','uses' => 'BookController@EditKatering']);
Route::delete('/delete-book-katering', ['uses' => 'BookController@deleteKatering','as' => 'deleteKatering']);

Route::get('/job-pending', ['as' => 'viewPendingJob','uses' => 'JobController@viewPendingJob']);
Route::post('/job-grabjob', ['as' => 'grabjob','uses' => 'JobController@grabjob']);
Route::get('/job-view/{job_id}', ['as' => 'viewJob','uses' => 'JobController@viewJob']);
Route::get('/job-view-quotation/{job_id}', ['as' => 'viewQuotation','uses' => 'JobController@viewQuotation']);
Route::post('/job-submit-quotation/{job_id}', ['as' => 'SubmitQuotation','uses' => 'JobController@SubmitQuotation']);
Route::get('/status-quotation', ['as' => 'viewStatusQuotation','uses' => 'JobController@viewStatusQuotation']);
Route::get('/list-job-request', ['as' => 'ListPendingJob','uses' => 'JobController@ListPendingJob']);
Route::get('/list-job-filter', ['as' => 'FilterListPendingJob','uses' => 'JobController@FilterListPendingJob']);
Route::get('/provider-quotation', ['as' => 'ProviderQuotation','uses' => 'JobController@ProviderQuotation']);
Route::get('/view-quotation', ['as' => 'viewQuotationDetails','uses' => 'JobController@viewQuotationDetails']);
Route::get('/detail-quotation/{booking_id}', ['as' => 'detailQuotation','uses' => 'JobController@detailQuotation']);
Route::get('/view-job-details/{booking_id}', ['as' => 'detailJobView','uses' => 'JobController@detailJobView']);
Route::get('/view-schedule-details/{booking_id}', ['as' => 'detailSchedule','uses' => 'JobController@detailSchedule']);

Route::get('/view-task-pembantu-rumah', ['as' => 'viewTaskPembantuRumah','uses' => 'ScheduleController@viewTaskPembantuRumah']);
Route::get('/view-task-urut-pantang', ['as' => 'viewTaskUrutPantang','uses' => 'ScheduleController@viewTaskUrutPantang']);
Route::get('/view-task-katering', ['as' => 'viewTaskKatering','uses' => 'ScheduleController@viewTaskKatering']);

Route::get('/type-service', ['as' => 'TypeService','uses' => 'TableController@TypeService']);
Route::get('/type-service/view-add', ['as' => 'viewAddTypeService','uses' => 'TableController@viewAddTypeService']);
Route::post('/type-service/add', ['as' => 'addTypeService','uses' => 'TableController@addTypeService']);
Route::get('/view-edit-type-service/{id}', ['as' => 'viewEditTypeService','uses' => 'TableController@viewEditTypeService']);
Route::post('/edit-typeservice-save/{id}', ['uses' => 'TableController@editTypeService','as' => 'editTypeService']);
Route::delete('/type-service/delete/{id}', ['uses' => 'TableController@deleteTypeService','as' => 'deleteTypeService']);

Route::get('/type-property', ['as' => 'TypeProperty','uses' => 'TableController@TypeProperty']);
Route::get('/type-property/view-add', ['as' => 'viewAddTypeProperty','uses' => 'TableController@viewAddTypeProperty']);
Route::post('/type-property/add', ['as' => 'addTypeProperty','uses' => 'TableController@addTypeProperty']);
Route::get('/view-edit-type-property/{id}', ['as' => 'viewEditTypeProperty','uses' => 'TableController@viewEditTypeProperty']);
Route::post('/edit-typeproperty-save/{id}', ['uses' => 'TableController@editTypeProperty','as' => 'editTypeProperty']);
Route::delete('/type-property/delete/{id}', ['uses' => 'TableController@deleteTypeProperty','as' => 'deleteTypeProperty']);

Route::get('/type-event', ['as' => 'TypeEvent','uses' => 'TableController@TypeEvent']);
Route::get('/type-event/view-add', ['as' => 'viewAddTypeEvent','uses' => 'TableController@viewAddTypeEvent']);
Route::post('/type-event/add', ['as' => 'addTypeEvent','uses' => 'TableController@addTypeEvent']);
Route::get('/view-edit-type-event/{id}', ['as' => 'viewEditTypeEvent','uses' => 'TableController@viewEditTypeEvent']);
Route::post('/edit-typeevent-save/{id}', ['uses' => 'TableController@editTypeEvent','as' => 'editTypeEvent']);
Route::delete('/type-event/delete/{id}', ['uses' => 'TableController@deleteTypeEvent','as' => 'deleteTypeEvent']);

});