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

DB::enableQueryLog();

// Auth routes
Route::group(['prefix' => 'auth', 'namespace' => 'Auth'], function () {

    Route::get('login', ['as' => 'auth.login', 'uses' => 'AuthController@getLogin']);

    Route::post('login', 'AuthController@postLogin');

    Route::get('logout', 'AuthController@getLogout');

});


Route::group(['middleware' => 'auth'], function () {

    Route::get('/', function () {

        $role = Auth::user()->roles()->first()->slug;

        return redirect()->to($role);

    });

    Route::group(['middleware' => 'role:admin', 'prefix' => 'admin', 'namespace' => 'Admin'], function () {

        Route::resource('students', 'StudentController');

        Route::resource('lecturers', 'LecturerController');

        Route::resource('departments', 'DepartmentController');

        Route::resource('lessons', 'LessonController');

        Route::resource('lessons-departments', 'LessonDepartmentController');

        Route::resource('lessons-students', 'LessonStudentController');

        Route::get('/', function () {
            return redirect()->route('admin.students.index');
        });

    });

    Route::group(['middleware' => 'role:student', 'prefix' => 'student','namespace' => 'Student'], function () {

        Route::get('/', function () {
            return redirect()->route('student.lessons.index');
        });

        Route::get('lesson-select/{id}/toggle',['as'=>'student.lesson-select.toggle','uses'=>'LessonSelectController@toggleLesson']);

        Route::resource('lesson-select','LessonSelectController');

        Route::resource('lessons','LessonController');

    });

    Route::group(['middleware' => 'role:lecturer', 'prefix' => 'lecturer','namespace' => 'Lecturer'], function () {

        Route::get('/', function () {

            return redirect()->route('lecturer.scores.index');

        });

        Route::resource('scores','ScoreController');

    });

    Route::group(['middleware' => 'role:secretary', 'prefix' => 'secretary'], function () {

        Route::get('/', function () {

            return "Merhaba Secretary";

        });

    });


});