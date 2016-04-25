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
Route::get('/course/available', 'Course\CourseController@getAvail');

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

    Route::get('/course/manage', 'CourseController@getCourseManage');
    Route::get('/course/{course_id}/edit', 'CourseController@getCourseEdit');
    Route::patch('/course/{course_id}/edit', 'CourseController@patchCourse');
    Route::get('/course/{course_id}/delete', 'CourseController@getCourseDelete');
    Route::get('/course/{course_id}/room', 'RoomController@getCourseRoom');
    Route::get('/course/{course_id}/{room_id}', 'RoomController@viewCourseRoom');
    Route::post('/course/{course_id}/{room_id}', 'RoomController@saveSeat');
    Route::delete('/course/{course_id}/{room_id}', 'RoomController@deleteSeat');
    Route::get('/course', 'CourseController@index');
    # Room route
    Route::get('/course/create', 'CourseController@getCourseCreate');
    Route::post('/course/create', 'CourseController@postCourseCreate');

    Route::get('/room/create', 'RoomController@getCreate');
    Route::post('/room/create', 'RoomController@postCreate');
    Route::get('/room/manage', 'RoomController@getManage');
    Route::get('/room/{room_id}/edit', 'RoomController@getRoomEdit');
    Route::post('/room/{room_id}/edit', 'RoomController@postRoomEdit');
    Route::get('/room/{room_id}/delete', 'RoomController@getRoomDelete');

    Route::get('/room/{room_id}', 'RoomController@getRoom');

    Route::get('/course/{course_id}', 'CourseController@getCourse');

    Route::post('/enroll/{course_id}', 'CourseController@postEnroll');
    Route::get('/enroll/{enroll_id}', 'CourseController@showEnroll');
    Route::post('/enroll/{enroll_id}/delete', 'CourseController@deleteEnroll');
    Route::get('/enroll', 'CourseController@getEnroll');

});

Route::group(['namespace' => 'Member'], function () {

    # Member Zone
    Route::get('/member', 'MemberController@index')->name('member');
    Route::get('/manager', 'MemberController@indexManager')->name('manager');
    Route::get('/manager/teacher', 'MemberController@getTeacher');
    Route::get('/member/profile', 'MemberController@showProfile')->name('profile');
    Route::post('/member/profile', 'MemberController@saveProfile');
    Route::get('/member/create', 'MemberController@getCreate');
    Route::post('/member/create', 'MemberController@postCreate');
    Route::get('/member/manage', 'MemberController@getManage');
    Route::get('/member/{user_id}/edit', 'MemberController@getEdit');
    Route::post('/member/{user_id}/edit', 'MemberController@postEdit');
    Route::get('/member/{user_id}/delete', 'MemberController@getDelete');

    Route::group(['middleware' => 'admin'], function () {
        Route::get('/teacher/manage', 'MemberController@getTeacherManage');
        Route::get('/teacher/create', 'MemberController@getTeacherCreate');
        Route::post('/teacher/create', 'MemberController@postTeacherCreate');
        Route::get('/teacher/{teacher_id}/delete', 'MemberController@deleteTeacher');
        Route::get('/teacher/{teacher_id}/edit', 'MemberController@editTeacher');
        Route::post('/teacher/{teacher_id}/edit', 'MemberController@saveTeacher');

        Route::get('/manager/manage', 'MemberController@getManagerManage');
        Route::get('/manager/create', 'MemberController@getManagerCreate');
        Route::post('/manager/create', 'MemberController@postManagerCreate');
        Route::get('/manager/{manager_id}/delete', 'MemberController@deleteManager');
        Route::get('/manager/{teacher_id}/edit', 'MemberController@editManager');
        Route::post('/manager/{teacher_id}/edit', 'MemberController@saveManager');
    });


});
Route::get('/timetable', 'HomeController@timetable');
Route::get('/timetable/{teacher_id}', 'HomeController@timetableById');

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

