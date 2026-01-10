<?php

use App\Http\Controllers\Secondcontroller;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeachersController;
use App\Http\Controllers\Testcontroller;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
return view('welcome');
});

Route::get('hello',function(){
    return 'hello from laravel';
});

Route::get('about',function()
{
    return 'about us';
});

Route::get('details/students',function()
{
    return 'this is student';
});

Route::get('details/teachers',function()
{
    return 'this is teacher';
});


Route::prefix('details')->group(function() {
    Route::get('students',function()
    {
        return 'this is student';
    });
})->name('student-Details');


Route::prefix('details')->group(function(){
    Route::get('teachers',function(){
        return 'this is teacher';
    });
})->name('teacher-Details');

Route::get('student/{id}/{reg}',function($id,$reg){
    return 'student number'.$id . 'Registration Number'.$reg;
});

Route::fallback(function() {
    return 'This page is not found pleae try again';
});

Route::get('about-us',function(){
    //$name = "tester";
    //$email = 'tester@gmail.com';
   // return view('aboutus')->with('name',$name)->with('email',$email);
   //return view('aboutus',compact('name','email'));
   //return view('aboutus',['name'=>$name,'email'=>$email]);
   //return view('aboutus',compact('name','id'));
   return view('aboutus');
});

Route::view('contact-us','contactus');

Route::get('students',[StudentController::class,'index']);
Route::get('about/{id}/{name}',[StudentController::class,'about']);

Route::get('invoke',Testcontroller::class);


Route::resource('second-test',Secondcontroller::class);

//Route::get('teachers',function())
//{
    //return Teachers::all()
//}

Route::get('teachers',[TeachersController::class,'index']);
Route::get('add-teacher',[TeachersController::class,'add']);
Route::get('show-teacher/{id}',[TeachersController::class,'show']);
Route::get('update-teacher/{id}',[TeachersController::class,'update']);
Route::get('delete-teacher/{id}',[TeachersController::class,'delete']);