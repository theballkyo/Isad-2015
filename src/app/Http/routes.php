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



Route::group(['namespace' => 'Payment'], function () {

    Route::get('/payment', 'PaymentController@index');
    Route::post('/payment', 'PaymentController@savePayment');
    Route::get('/payment/wait', 'PaymentController@getWait');
    Route::get('/payment/{enroll_id}/new', 'PaymentController@newPayment');
    Route::get('/payment/{enroll_id}/approve', 'PaymentController@approve');
    Route::get('/payment/{enroll_id}/reject', 'PaymentController@reject');
    Route::get('/payment/{enroll_id}', 'PaymentController@getPayment');

});

Route::group(['namespace' => 'Course'], function () {

    # Room route
    Route::get('/room', 'RoomController@index');
    Route::get('/room/create', 'RoomController@getCreate');
    Route::get('/room/manage', 'RoomController@getManage');
    Route::get('/room/{room_id}', 'RoomController@getRoom');
    Route::get('/course', 'CourseController@index');
    Route::get('/course/create', 'CourseController@getCourseCreate');
    Route::post('/course/create', 'CourseController@postCourseCreate');
    Route::get('/course/manage', 'CourseController@getCourseManage');
    Route::get('/course/{course_id}', 'CourseController@getCourse');
    Route::get('/course/{course_id}/edit', 'CourseController@getCourseEdit');
    Route::patch('/course/{course_id}/edit', 'CourseController@patchCourse');
    Route::get('/course/{course_id}/room', 'RoomController@getCourseRoom');
    Route::get('/course/{course_id}/{room_id}', 'RoomController@viewCourseRoom');
    Route::post('/course/{course_id}/{room_id}', 'RoomController@saveSeat');
    Route::delete('/course/{course_id}/{room_id}', 'RoomController@deleteSeat');
});

Route::group(['namespace' => 'Member'], function () {
    # Member Zone
    Route::get('/member', 'MemberController@index')->name('member');
    Route::get('/member/profile', 'MemberController@showProfile')->name('profile');
    Route::get('/member/manage', 'MemberController@getManage');
    Route::get('/member/create', 'MemberController@getCreate');
    Route::post('/member/create', 'MemberController@postCreate');
    Route::get('/member/{user_id}/edit', 'MemberController@getEdit');
    Route::patch('/member/{user_id}/edit', 'MemberController@patch');
    Route::get('/manager', 'MemberController@indexManager')->name('manager');
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

