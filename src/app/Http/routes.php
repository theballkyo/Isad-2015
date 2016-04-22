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

# Member Zone
Route::get('/member', 'Member\MemberController@index')->name('member');
Route::get('/member/profile', 'Member\MemberController@showProfile')->name('profile');

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
Route::post('/enroll/{course_id}/delete', 'Course\CourseController@deleteEnroll');
// Enroll course
Route::post('/enroll/{course_id}', 'Course\CourseController@postEnroll');

Route::get('/enroll/{enroll_id}', 'Course\CourseController@showEnroll');
\
// Show courses has enroll
Route::get('/enroll', 'Course\CourseController@getEnroll');

Route::get('/payment', 'Payment\PaymentController@index');

Route::get('/payment/{enroll_id}', 'Payment\PaymentController@getPayment');

Route::get('payment/{enroll_id}/new', 'Payment\PaymentController@newPayment');

Route::post('payment', 'Payment\PaymentController@savePayment');


Route::group(['namespace' => 'Course'], function () {

    # Room route
    Route::get('room', 'RoomController@index');
    Route::get('room/{room_id}', 'RoomController@getRoom');
    Route::get('/course/{course_id}/room', 'RoomController@getCourseRoom');
    Route::get('/course/{course_id}/{room_id}', 'RoomController@viewCourseRoom');
    Route::post('/course/{course_id}/{room_id}', 'RoomController@saveSeat');
    Route::delete('/course/{course_id}/{room_id}', 'RoomController@deleteSeat');
});

Route::auth();

Route::get('/home', 'HomeController@index');

Route::get('/generate', function () {
    $imgs = ['a.jpg', 'b.jpg', 'c.jpg', 'd.jpg'];
    for ($i = 0; $i < 10; $i++) {
        \App\Course::create([
            'title' => str_random(8),
            'description' => str_random(32),
            'img' => $imgs[random_int(0, 3)],
            'price' => random_int(100, 10000),
            'max_user' => random_int(1, 100),
            'is_open' => 1,
            'type' => random_int(1, 2),
            'teacher_id' => 2
        ]);
    }
});

