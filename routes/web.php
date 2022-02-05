<?php

use App\Test;
use App\TestFacade;
use App\Container;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function(){

//    return TestFacade::execute();

//    dd(resolve('test')->execute());

//    dd(app('test')->execute());

      return view('welcome');



  
});

Route::middleware(['auth:sanctum', 'verified'])->resource('/posts',HomeController::class);

Route::get('/logout',[AuthController::class,'logout']);


// Route::get('contact/{name}', function($name){

//     return "$name";

//     $data = "some data";
    
//     return view('contact',['data'=>$data]);
// });




// Route::get('contact/{name}',function($name){

//     return "$name";
//     $data = request('name');

//     return view('contact',['data' => $data]);

// });
