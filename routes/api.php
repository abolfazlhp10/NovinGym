<?php

use App\Http\Controllers\ProgramsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CoachsController;
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
Route::post('login/', [CoachsController::class, 'login'])->middleware('throttle:login')->name('login');

//signup coach
Route::post('signup/', [CoachsController::class, 'register'])->middleware('throttle:register');


Route::middleware('auth:sanctum')->prefix('coach')->group(

    function () {

        //create new program
        Route::post('programs/', [ProgramsController::class, 'store']);

        //show program
        Route::get('programs/{programID}', [ProgramsController::class, 'show']);

        //delete program
        Route::delete('programs/{programID}', [ProgramsController::class, 'destroy']);
    }

);


Route::get('/coaches', [CoachsController::class, 'index']);
