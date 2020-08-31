<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
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
Route::group(['prefix' => 'commands'], function(){

     Route::get('/artisan/{command}', function($command){

         try {
             \Illuminate\Support\Facades\Artisan::call($command);
         } catch(\Exception $e){
             dd($e->getMessage());
         }

         dd(\Illuminate\Support\Facades\Artisan::output());
     });


    Route::get('terminal/{command}', function($command) {
        $cli = new \Symfony\Component\Process\Process(['composer' => 'install']);
        $cli->run();

        dd($cli->getOutput());
    });

});

Route::get('/', function () {
    View::addExtension('html', 'php');
    return View::make('index');
});