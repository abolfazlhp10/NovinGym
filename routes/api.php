<?php

use App\Http\Controllers\AdminsController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\ProgramsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CoachesController;
use App\Http\Controllers\ExercisesController;
use App\Http\Controllers\PaymentsController;
use App\Http\Controllers\SubscriptionsController;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

//login coach
Route::post('login/', [CoachesController::class, 'login'])->middleware('throttle:login')->name('login');

//signup coach
Route::post('signup/', [CoachesController::class, 'register'])->middleware('throttle:register');


Route::middleware('auth:sanctum')->prefix('coach')->group(

    function () {

        //create new program
        Route::post('programs/', [ProgramsController::class, 'store']);

        //show program
        Route::get('programs/{programID}', [ProgramsController::class, 'show']);

        //delete program
        Route::delete('programs/{programID}', [ProgramsController::class, 'destroy']);

        //payment routes
        Route::post('payment/{sub_id}/{username}', [PaymentsController::class, 'request']);

        Route::get('verify/{sub_id}/{username}', [PaymentsController::class, 'verify'])->name('verify');
    }

);

//login admin
Route::post('admin1010/login', [AdminsController::class, 'login']);

Route::middleware(['auth:sanctum', 'isAdmin'])->prefix('admin')->group(function () {

    //show all coaches
    Route::get('/coaches', [CoachesController::class, 'index']);



    //store new subscription
    Route::post('subscriptions/', [SubscriptionsController::class, 'store']);

    //show list of subscriptions
    Route::get('subscriptions/', [SubscriptionsController::class, 'index']);

    //delete subscription
    Route::delete('subscriptions/{id}', [SubscriptionsController::class, 'destroy']);



    //show all categories
    Route::get('categories/', [CategoriesController::class, 'index']);

    //make new category
    Route::post('categories/', [CategoriesController::class, 'store']);

    //edit category
    Route::get('categories/{id}/edit', [CategoriesController::class, 'edit']);


    //update category
    Route::put('categories/{id}', [CategoriesController::class, 'update'], 204);

    //delete category
    Route::delete('categories/{id}', [CategoriesController::class, 'destroy'], 204);



    //add new exercise
    Route::post('exercises/', [ExercisesController::class, 'store']);

    //show all exercises
    Route::get('exercises/', [ExercisesController::class, 'index']);

    //edit exercise
    Route::get('exercises/{id}/edit', [ExercisesController::class, 'edit']);

    //update exercise
    Route::put('exercises/{id}', [ExercisesController::class, 'update']);

    //delete exercise
    Route::delete('exercises/{id}', [ExercisesController::class, 'destroy']);
});


//ToDo : add edit func for category
