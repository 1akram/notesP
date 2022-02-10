<?php
 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\noteController;
use App\Http\Controllers\Api\authController;
 

 
// appConf(AppConfirmation) middleware check if the request comes from authorized app (in this case just my app )not other apps that have the api link 
 Route::group(['middleware'=>['api','auth:api','appConf']   ],function(){
    
    route::post('/notes',[noteController::class, 'notes']);
    route::post('/add',[noteController::class, 'add']);
    route::post('/edit',[noteController::class, 'edit']);
    route::post('/delete',[noteController::class, 'delete']);
    route::post('/logout',[authController::class, 'logout']);
});
route::post('/login',[authController::class, 'login']);