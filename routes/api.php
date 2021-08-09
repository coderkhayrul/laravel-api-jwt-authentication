<?php

use App\Http\Controllers\Api\CourseController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'login']);

Route::group(['middleware' => ['auth:api']], function () {
    Route::get('/profile', [UserController::class, 'profile']);
    Route::get('/logout', [UserController::class, 'logout']);

    // COUESES API ROUTES
    Route::post('/course-enrol', [CourseController::class, 'courseEnrollment']);
    Route::get('/total-course', [CourseController::class, 'totalcourses']);
    Route::get('/delete-course/{id}', [CourseController::class, 'deleteCourse']);
});



Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
