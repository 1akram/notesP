<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\NoteController;;



Route::middleware(['guest'])->group(function () {// accesse for non logged users 

    
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/Auth', [AuthController::class, 'loginAuth'])->name('loginAuth');
    Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/registerSave', [AuthController::class, 'registerSave'])->name('registerSave');


});



Route::middleware(['auth:web'])->group(function () {// accesse for logged users


    Route::get('/', [NoteController::class, 'read'])->name('home');
    Route::get('/notes/create', [NoteController::class, 'create'])->name('createNote');
    Route::post('/notes/create/save', [NoteController::class, 'save'])->name('saveNote');
    Route::get('/notes/edit/{id}', [NoteController::class, 'edit'])->name('editNote');
    Route::post('/notes/edit/{id}/update', [NoteController::class, 'update'])->name('updateNote');
    Route::get('/notes/delete/{id}', [NoteController::class, 'delete'])->name('deleteNote');
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    
    
});


//public accesse

Route::get('/share/note/{shareToken}', [NoteController::class, 'share'])->name('shareNote');