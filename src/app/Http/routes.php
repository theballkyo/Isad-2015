<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
 */
Route::get('/', 'HomeController@index');
// View all courses
Route::get('/course', 'Course\CourseController@index');

// Show form new course
Route::get('/course/create', 'Course\CourseController@getCourseCreate');

// Store new course
Route::post('/course/create', 'Course\CourseController@postCourseCreate');

// View course
Route::get('/course/{course_id}', 'Course\CourseController@getCourse');

// View edit course
Route::get('/course/{course_id}/edit', 'Course\CourseController@getCourseEdit');

// Edit course
Route::patch('/course/{course_id}', 'Course\CourseController@patchCourse');

// Remove course
Route::delete('/course/{course_id}', 'Course\CourseController@deleteCourse');

// Enroll course
Route::post('/enroll/{course_id}', 'Course\CourseController@postEnroll');

// remove enroll course
Route::delete('/enroll/{course_id}', 'Course\CourseController@deleteEnroll');

// Show courses has enroll
Route::get('/enroll', 'Course\CourseController@getEnroll');

Route::get('/payment', 'Payment\PaymentController@index');

Route::get('/payment/{enroll_id}', 'Payment\PaymentController@getPayment');

Route::get('payment/{enroll_id}/new', 'Payment\PaymentController@newPayment');

Route::post('payment', 'Payment\PaymentController@savePayment');

Route::auth();

Route::get('/home', 'HomeController@index');

