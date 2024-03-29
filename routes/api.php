<?php

use App\Http\Controllers\StudentController;
use App\Http\Controllers\UserController;
use App\Models\Student;
use App\Models\User;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });                             //this santum route is also predefined

Route::get('/student',function(){
    return "all student info";
});

// Route::get('/allstudent',[StudentController::class,'index'])->name('all.student');
// Route::get('/allstudent/{id}',[StudentController::class,'show'])->name('specific.student');
// Route::post('addstudents',[StudentController::class,'store'])->name('store.student');
// Route::put('/updatestudent/{id}',[StudentController::class,'update'])->name('update.student');

// Route::delete('/deleteStudent/{id}',[StudentController::class,'destroy'])->name('delete.student');

// Route::get('searchStudent/{city}',[StudentController::class,'search'])->name('student.search');



// Route::post('registratinToken',[UserController::class,'register'])->name('user.token');

// Route::middleware('auth:sanctum')->get('/allstudent',[StudentController::class,'index'])
// ->name('all.student');
// Route::middleware('auth:sanctum')->get('/allstudent/{id}',[StudentController::class,'show'])
// ->name('specific.student');

//now grouping the routes


Route::middleware(['auth:sanctum'])->group(function(){

//put all the routes here without the registration route
// Route::get('/allstudent',[StudentController::class,'index'])->name('all.student');
// Route::get('/allstudent/{id}',[StudentController::class,'show'])->name('specific.student');
Route::post('addstudents',[StudentController::class,'store'])->name('store.student');
Route::put('/updatestudent/{id}',[StudentController::class,'update'])->name('update.student');

Route::delete('/deleteStudent/{id}',[StudentController::class,'destroy'])->name('delete.student');

// Route::get('searchStudent/{city}',[StudentController::class,'search'])->name('student.search');

//now making the route of the  Logout

Route::post('/logout', [UserController::class,'logout'])->name('user.logout');
});

//now partiall protected Routes
//partially protected routes are basically GET routes and POST are private route
Route::post('registratinToken',[UserController::class,'register'])->name('user.token');
Route::get('/allstudent',[StudentController::class,'index'])->name('all.student');
Route::get('/allstudent/{id}',[StudentController::class,'show'])->name('specific.student');
Route::get('searchStudent/{city}',[StudentController::class,'search'])->name('student.search');
//this is a login route and this remains public because we here providing the tokens
Route::post('/login',[UserController::class,'login'])->name('user.login');

Route::resource('student',StudentController::class);
